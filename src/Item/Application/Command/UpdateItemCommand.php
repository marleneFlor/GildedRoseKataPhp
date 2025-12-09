<?php

declare(strict_types=1);

namespace GildedRose\Item\Application\Command;

class UpdateItemCommand
{
    private function __construct(
        public string $name,      // <--- Semánticamente es el ID de búsqueda
        public int $sellIn,
        public int $quality,
    ) {
    }

    public static function create(string $name, int $sellIn, int $quality): self
    {
        return new self($name, $sellIn, $quality);
    }
}