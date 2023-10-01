<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\UseCase\ShowTestResult;

use DDA58\MagicTestCase\TestResult\Application\Dto\ShowTestResultDto;
use DDA58\MagicTestCase\TestResult\Application\UseCase\ShowTestResult\Exception\TestResultNotFoundException;
use DDA58\MagicTestCase\TestResult\Domain\Repository\TestResultRepositoryInterface;
use DDA58\MagicTestCase\TestResult\Domain\ValueObject\TestResultId;
use JsonException;

readonly class ShowTestResultUseCase implements ShowTestResultUseCaseInterface
{
    private const TEST_RESULT_NOT_FOUND = '[ShowTestResultUseCase] Test result not found';

    public function __construct(
        private TestResultRepositoryInterface $testResultRepository,
    ) {
    }

    public function handle(TestResultId $id): ShowTestResultDto
    {
        $testResult = $this->testResultRepository->find($id);

        if ($testResult === null) {
            throw new TestResultNotFoundException(self::TEST_RESULT_NOT_FOUND);
        }

        $correctNames = [];
        $notCorrectNames = [];

        try {
            /**
             * @var int[][] $result
             */
            $result = json_decode($testResult->getResult(), true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            //TODO log... and exception?
            $result = [];
        }

        $test = $testResult->getTest();

        foreach ($test->getQuestions() as $question) {
            $answers = $result[$question->getId()] ?? [];
            $questionName = $question->getQuestion();

            if ($answers === []) {
                $notCorrectNames[] = $questionName;

                continue;
            }

            $hasNotCorrect = false;

            foreach ($question->getOptions() as $option) {
                if ($option->isCorrect() === false && in_array($option->getId(), $answers, true)) {
                    $hasNotCorrect = true;

                    break;
                }
            }

            $hasNotCorrect ? $notCorrectNames[] = $questionName :  $correctNames[] = $questionName;
        }

        return new ShowTestResultDto(
            $test->getName(),
            $correctNames,
            $notCorrectNames
        );
    }
}
