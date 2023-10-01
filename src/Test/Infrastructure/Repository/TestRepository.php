<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Infrastructure\Repository;

use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;
use DDA58\MagicTestCase\Test\Domain\Repository\TestRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TestRepository extends ServiceEntityRepository implements TestRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestEntity::class);
    }
}
