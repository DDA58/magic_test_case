<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\UseCase\ShowTest;

use DDA58\MagicTestCase\Test\Application\Dto\TestDto;
use DDA58\MagicTestCase\Test\Application\Mapper\TestWithShuffle\TestWithShuffleMapperInterface;
use DDA58\MagicTestCase\Test\Application\Service\FindTest\FindTestServiceInterface;
use DDA58\MagicTestCase\Test\Domain\ValueObject\TestId;

readonly class ShowTestUseCase implements ShowTestUseCaseInterface
{
    public function __construct(
        private FindTestServiceInterface $findTestService,
        private TestWithShuffleMapperInterface $testWithShuffleMapper,
    ) {
    }

    public function handle(TestId $id): ?TestDto
    {
        $test = $this->findTestService->handle($id);

        if ($test === null) {
            return null;
        }

        return $this->testWithShuffleMapper->map($test);
    }
}
