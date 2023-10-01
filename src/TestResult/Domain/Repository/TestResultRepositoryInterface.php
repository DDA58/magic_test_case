<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\TestResult\Domain\Repository;

use DDA58\MagicTestCase\TestResult\Domain\Entity\TestResultEntity;

interface TestResultRepositoryInterface
{
    /**
     * @param mixed $id
     * @param int|null $lockMode
     * @param int|null $lockVersion
     * @return TestResultEntity|null
     */
    public function find($id, $lockMode = null, $lockVersion = null);

    public function save(TestResultEntity $testResultEntity): void;
}
