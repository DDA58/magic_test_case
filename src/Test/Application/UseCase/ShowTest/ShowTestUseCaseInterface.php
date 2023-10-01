<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Test\Application\UseCase\ShowTest;

use DDA58\MagicTestCase\Test\Application\Dto\TestDto;
use DDA58\MagicTestCase\Test\Domain\ValueObject\TestId;

interface ShowTestUseCaseInterface
{
    public function handle(TestId $id): ?TestDto;
}
