<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Application\Dto;

readonly class ShowTestResultDto
{
    /**
     * @param string[] $correctQuestions
     * @param string[] $uncorrectQuestions
     */
    public function __construct(
        private string $testName,
        private array $correctQuestions,
        private array $uncorrectQuestions,
    ) {
    }

    public function getTestName(): string
    {
        return $this->testName;
    }

    public function getCorrectQuestions(): array
    {
        return $this->correctQuestions;
    }

    public function getUncorrectQuestions(): array
    {
        return $this->uncorrectQuestions;
    }
}
