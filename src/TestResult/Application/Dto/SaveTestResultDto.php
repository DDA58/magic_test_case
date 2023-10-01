<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\Dto;

use DDA58\MagicTestCase\Test\Domain\ValueObject\TestId;

readonly class SaveTestResultDto
{
    public function __construct(
        private TestId $testId,
        private array $questions
    ) {
    }

    public function getTestId(): TestId
    {
        return $this->testId;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }
}
