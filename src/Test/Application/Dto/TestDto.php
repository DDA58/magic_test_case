<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Dto;

readonly class TestDto
{
    /**
     * @param QuestionDto[] $questions
     */
    public function __construct(
        private int $id,
        private string $name,
        private array $questions = [],
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }
}
