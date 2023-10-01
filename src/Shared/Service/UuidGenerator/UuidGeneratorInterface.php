<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Shared\Service\UuidGenerator;

use Ramsey\Uuid\UuidInterface;

interface UuidGeneratorInterface
{
    public function handle(): UuidInterface;
}
