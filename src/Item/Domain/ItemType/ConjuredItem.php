<?php

declare(strict_types=1);

namespace GildedRose\ItemType;

use GildedRose\Item;
use GildedRose\ItemUpdater;

/**
 * Conjurado mágico disminuye su calidad con el tiempo, el doble de rápido.
 * Después de la fecha de venta, dismuye el doble.
 */
class ConjuredItem extends ItemUpdater
{
    public function updateQuality(): void
    {
        $this->decreaseSellIn();

        $this->decreaseQuality(2);

        // Si la fecha de venta ha pasado, la calidad disminuye el doble de rápido
        if ($this->item->sellIn < 0) {
            $this->decreaseQuality(2);
        }
    }
}
