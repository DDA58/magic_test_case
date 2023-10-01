<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult;

use DateTimeImmutable;
use DDA58\MagicTestCase\Shared\Service\UuidGenerator\UuidGeneratorInterface;
use DDA58\MagicTestCase\Test\Application\Service\FindTest\FindTestServiceInterface;
use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;
use DDA58\MagicTestCase\TestResult\Application\Dto\SaveTestResultDto;
use DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult\Exception\QuestionsStructureNotValidException;
use DDA58\MagicTestCase\TestResult\Application\UseCase\SaveTestResult\Exception\TestNotFoundException;
use DDA58\MagicTestCase\TestResult\Domain\Entity\TestResultEntity;
use DDA58\MagicTestCase\TestResult\Domain\Repository\TestResultRepositoryInterface;
use DDA58\MagicTestCase\TestResult\Domain\ValueObject\TestResultId;

readonly class SaveTestResultUseCase implements SaveTestResultUseCaseInterface
{
    private const TEST_NOT_FOUND = '[SaveTestResultUseCase] Test not found';
    private const QUESTIONS_STRUCTURE_NOT_VALID = '[SaveTestResultUseCase] Questions structure is not valid';
    public function __construct(
        private FindTestServiceInterface $findTestService,
        private TestResultRepositoryInterface $testResultRepository,
        private UuidGeneratorInterface $uuidGenerator,
    ) {
    }

    public function handle(SaveTestResultDto $saveTestResultDto): TestResultEntity
    {
        $questions = $saveTestResultDto->getQuestions();
        $testId = $saveTestResultDto->getTestId();

        $this->guardStructure($questions);

        /**
         * @var string[][] $questions
         */
        $test = $this->findTestService->handle($testId);

        if ($test === null) {
            throw new TestNotFoundException(self::TEST_NOT_FOUND);
        }

        $testResult = TestResultEntity::create(
            new TestResultId(
                $this->uuidGenerator->handle()->toString()
            ),
            $test,
            $this->prepareResult($test, $questions),
            new DateTimeImmutable('now')
        );

        $this->testResultRepository->save($testResult);

        return $testResult;
    }

    /**
     * @param string[][] $questions
     */
    private function prepareResult(TestEntity $testEntity, array $questions): string
    {
        $result = [];

        foreach ($testEntity->getQuestions() as $question) {
            $questionId = $question->getId();
            $result[$questionId] = array_key_exists($questionId, $questions)
                ? array_map(
                    static fn(string $id): int => (int)$id,
                    $questions[$questionId]
                )
                : [];
        }

        $json = json_encode($result);

        if ($json === false) {
            throw new QuestionsStructureNotValidException(self::QUESTIONS_STRUCTURE_NOT_VALID);
        }

        return $json;
    }

    /**
     * @throws QuestionsStructureNotValidException
     */
    private function guardStructure(array $questions): void
    {
        foreach ($questions as $questionId => $options) {
            if (is_int($questionId) === false || is_array($options) === false) {
                throw new QuestionsStructureNotValidException(self::QUESTIONS_STRUCTURE_NOT_VALID);
            }

            /**
             * @var array $options
             * @psalm-suppress MixedAssignment
             */
            foreach ($options as $option) {
                if ((int)$option === 0) {
                    throw new QuestionsStructureNotValidException(self::QUESTIONS_STRUCTURE_NOT_VALID);
                }
            }
        }
    }
}
