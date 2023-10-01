<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Domain\Entity;

use DateTimeImmutable;
use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;
use DDA58\MagicTestCase\TestResult\Domain\Repository\TestResultRepositoryInterface;
use DDA58\MagicTestCase\TestResult\Domain\ValueObject\TestResultId;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @psalm-suppress InvalidArgument
 */
#[ORM\Entity(repositoryClass: TestResultRepositoryInterface::class)]
#[Table(name: 'tests_results')]
class TestResultEntity
{
    #[ORM\Id]
    #[ORM\Column]
    private string $id;

    #[ORM\Column(type: 'json')]
    private string $result;

    #[OneToOne(targetEntity: TestEntity::class)]
    #[JoinColumn(name: 'test_id', referencedColumnName: 'id')]
    private TestEntity $test;

    #[ORM\Column(name: 'created_at', type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public static function create(
        TestResultId $id,
        TestEntity $testId,
        string $result,
        DateTimeImmutable $createdAt
    ): self {
        $entity = new self();
        $entity->setId($id->getValue());
        $entity->test = $testId;
        $entity->setResult($result);
        $entity->setCreatedAt($createdAt);

        return $entity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function setResult(string $result): void
    {
        $this->result = $result;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTest(): TestEntity
    {
        return $this->test;
    }
}
