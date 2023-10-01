<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @psalm-suppress InvalidArgument
 */
#[ORM\Entity]
#[Table(name: 'questions')]
class QuestionEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $question;

    /**
     * @var Collection<int, QuestionOptionEntity>
     */
    #[OneToMany(mappedBy: 'question', targetEntity: QuestionOptionEntity::class, fetch: 'EAGER')]
    private Collection $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return Collection<int, QuestionOptionEntity>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }
}
