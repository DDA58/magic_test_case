<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Dto;

readonly class QuestionOptionDto
{
    public function __construct(
        private int $id,
        private string $option,
        private bool $isCorrect
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOption(): string
    {
        return $this->option;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}
