<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Mapper\TestWithShuffle;

use DDA58\MagicTestCase\Test\Application\Dto\TestDto;
use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;

interface TestWithShuffleMapperInterface
{
    public function map(TestEntity $testEntity): TestDto;
}
