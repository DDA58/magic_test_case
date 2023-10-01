<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Domain\Repository;

use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;

interface TestRepositoryInterface
{
    /**
     * @param mixed $id
     * @param int|null $lockMode
     * @param int|null $lockVersion
     * @return TestEntity|null
     */
    public function find($id, $lockMode = null, $lockVersion = null);
}
