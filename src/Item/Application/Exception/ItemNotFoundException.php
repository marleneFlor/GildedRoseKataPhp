<?php

declare(strict_types=1);

namespace GildedRose\Item\Application\Exception;

use RuntimeException;

class ItemNotFoundException extends RuntimeException
{
    public static function withName(string $name): self
    {
        return new self(sprintf('Item with name <%s> was not found.', $name));
    }

    public static function withId(string $id): self
    {
        return new self(sprintf('Item with ID <%s> was not found.', $id));
    }
}