<?php

declare(strict_types=1);

namespace GildedRose\ItemType;

use GildedRose\Item;
use GildedRose\ItemUpdater;

/*
 * Sulfuras es un item legendario que no cambia su calidad ni su fecha de venta.
 */
class SulfurasItem extends ItemUpdater
{
    public function updateQuality(): void {
        // Nada
    }
}
