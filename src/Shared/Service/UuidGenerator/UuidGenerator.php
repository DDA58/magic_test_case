<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Shared\Service\UuidGenerator;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class UuidGenerator implements UuidGeneratorInterface
{
    public function handle(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
