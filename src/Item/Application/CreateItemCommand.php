<?php

declare(strict_types=1);

namespace GildedRose;

class CreateItemCommand
{
    private function __construct(
        public string $name,
        public int $sellIn,
        public int $quality,
    ) {
    }

    public static function create(
        string $name, int $sellIn, int $quality
    ): self
    {
        return new self($name, $sellIn, $quality);
    }
}
