<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Entity;

use GildedRose\Item;
use GildedRose\Item\Domain\ValueObject\Quality;

class DomainItem
{
    public function __construct(
        private Item $item
    ) {}

    public static function create(string $name, int $sellIn, Quality $quality): self
    {
        // Crea el Item Legacy y lo envuelve en el DomainItem
        return new self(new Item($name, $sellIn, $quality->value()));
    }

    public function updateManual(Quality $quality, int $sellIn): void
    {
        $this->item->quality = $quality->value();
        $this->item->sellIn = $sellIn;
    }

    public function name(): string
    {
        return $this->item->name;
    }

    public function sellIn(): int
    {
        return $this->item->sellIn;
    }

    public function quality(): int
    {
        return $this->item->quality;
    }

    public function decreaseSellIn(): void
    {
        $this->item->sellIn--;
    }

    public function setQuality(int $q): void
    {
        $this->item->quality = max(0, min(50, $q));
    }

    public function dropQualityToZero(): void
    {
        $this->item->quality = 0;
    }

    public function increaseQuality(int $amount = 1): void
    {
        $this->item->quality = min(50, $this->item->quality + $amount);
    }

    public function decreaseQuality(int $amount = 1): void
    {
        $this->item->quality = max(0, $this->item->quality - $amount);
    }

    public function getLegacyItem(): Item
    {
        return $this->item;
    }
}
