<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Dto;

readonly class QuestionDto
{
    /**
     * @param QuestionOptionDto[] $options
     */
    public function __construct(
        private int $id,
        private string $question,
        private array $options = [],
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
