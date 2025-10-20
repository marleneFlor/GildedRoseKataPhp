<?php

namespace GildedRose;

abstract class ItemUpdater
{
    protected Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    abstract public function updateQuality(): void;

    protected function decreaseSellIn(): void
    {
        $this->item->sellIn--;
    }

    protected function increaseQuality(int $value = 1): void
    {
        $this->item->quality = min(50, $this->item->quality + $value);
    }

    protected function decreaseQuality(int $value = 1): void
    {
        $this->item->quality = max(0, $this->item->quality - $value);
    }
}
