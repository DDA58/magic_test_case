<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\Service\FindTest;

use DDA58\MagicTestCase\Test\Domain\Entity\TestEntity;
use DDA58\MagicTestCase\Test\Domain\Repository\TestRepositoryInterface;
use DDA58\MagicTestCase\Test\Domain\ValueObject\TestId;

readonly class FindTestService implements FindTestServiceInterface
{
    public function __construct(
        private TestRepositoryInterface $testRepository,
    ) {
    }

    public function handle(TestId $id): ?TestEntity
    {
        return $this->testRepository->find($id->getValue());
    }
}
