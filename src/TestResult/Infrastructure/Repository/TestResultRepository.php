<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Infrastructure\Repository;

use DDA58\MagicTestCase\TestResult\Domain\Entity\TestResultEntity;
use DDA58\MagicTestCase\TestResult\Domain\Repository\TestResultRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TestResultRepository extends ServiceEntityRepository implements TestResultRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestResultEntity::class);
    }

    public function save(TestResultEntity $testResultEntity): void
    {
        $this->_em->persist($testResultEntity);
        $this->_em->flush();
    }
}
