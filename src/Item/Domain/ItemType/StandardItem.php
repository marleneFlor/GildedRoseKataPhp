<?php

declare(strict_types=1);

namespace GildedRose\ItemType;

use GildedRose\Item;
use GildedRose\ItemUpdater;

/**
 * Item estándar disminuye su calidad con el tiempo.
 * Después de la fecha de venta, disminuye el doble.
 */
class StandardItem extends ItemUpdater
{
    public function updateQuality(): void
    {
        $this->decreaseSellIn();

        $this->decreaseQuality();

        if ($this->item->sellIn < 0) {
            $this->decreaseQuality();
        }
    }
}
