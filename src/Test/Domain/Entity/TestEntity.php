<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Domain\Entity;

use DDA58\MagicTestCase\Test\Domain\Repository\TestRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @psalm-suppress InvalidArgument
 */
#[ORM\Entity(repositoryClass: TestRepositoryInterface::class)]
#[Table(name: 'tests')]
class TestEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    /**
     * @var Collection<int, QuestionEntity>
     */
    #[JoinTable(name: 'questions4tests')]
    #[JoinColumn(name: 'test_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'question_id', referencedColumnName: 'id')]
    #[ManyToMany(targetEntity: QuestionEntity::class, fetch: 'EAGER')]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, QuestionEntity>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }
}
