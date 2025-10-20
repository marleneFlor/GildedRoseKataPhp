<?php

declare(strict_types=1);

namespace GildedRose\ItemType;

use GildedRose\Item;
use GildedRose\ItemUpdater;

/**
 * Aged Brie aumenta su calidad con el tiempo.
 * Después de la fecha de venta, aumenta el doble.
 */
class AgedBrie extends ItemUpdater
{
    public function updateQuality(): void
    {
        $this->decreaseSellIn();

        $this->increaseQuality();

        if ($this->item->sellIn < 0) {
            $this->increaseQuality();
        }
    }
}
