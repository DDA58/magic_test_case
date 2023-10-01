<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @psalm-suppress InvalidArgument
 */
#[ORM\Entity]
#[Table(name: 'questions_options')]
class QuestionOptionEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $option;

    #[ORM\Column(name: 'is_correct', type: 'boolean')]
    private bool $isCorrect;

    #[ManyToOne(targetEntity: QuestionEntity::class, inversedBy: 'options')]
    #[JoinColumn(name: 'question_id', referencedColumnName: 'id')]
    private QuestionEntity $question;

    public function getId(): int
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
