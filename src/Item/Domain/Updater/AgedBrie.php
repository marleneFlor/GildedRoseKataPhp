<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Updater;

/**
 * Aged Brie aumenta su calidad con el tiempo.
 * Después de la fecha de venta, aumenta el doble.
 */

use GildedRose\Item\Domain\Entity\DomainItem;

class AgedBrie implements ItemUpdater
{
    public function update(DomainItem $item): void
    {
        $item->decreaseSellIn();
        $item->increaseQuality();

        if ($item->sellIn() < 0) {
            $item->increaseQuality();
        }
    }
}