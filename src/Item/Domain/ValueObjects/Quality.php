<?php

declare(strict_types=1);

namespace GildedRose;

class Quality implements \Integerable
{
    private function __construct(
        private int $value
    ) {
    }

    public function getQuality(): int
    {
        return $this->value;
    }

    public function updateQuality(int $quality): void
    {
        $this->value = $quality;
    }

    public static function create(int $quality): self
    {
        return new self($quality);
    }
}