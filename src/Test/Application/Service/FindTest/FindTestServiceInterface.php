<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Service\FindTest;

use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;
use DDA58\MagicTestCase\Test\Domain\ValueObject\TestId;

interface FindTestServiceInterface
{
    public function handle(TestId $id): ?TestEntity;
}
