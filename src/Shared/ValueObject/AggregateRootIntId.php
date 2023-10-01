<?php

declare(strict_types=1);

namespace DDA58\MagicTestCase\Shared\ValueObject;

use InvalidArgumentException;

readonly abstract class AggregateRootIntId
{
    protected int $id;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(mixed $id)
    {
        if (is_int($id) === false) {
            throw new InvalidArgumentException('Not valid id');
        }

        $this->id = $id;
    }

    public function getValue(): int
    {
        return $this->id;
    }
}
