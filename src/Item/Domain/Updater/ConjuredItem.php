<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Updater;

/**
 * Conjurado mágico disminuye su calidad con el tiempo, el doble de rápido.
 * Después de la fecha de venta, dismuye el doble.
 */

use GildedRose\Item\Domain\Entity\DomainItem;

class ConjuredItem implements ItemUpdater
{
    public function update(DomainItem $item): void
    {
        $item->decreaseSellIn();
        $item->decreaseQuality(2); // Degrada doble

        if ($item->sellIn() < 0) {
            $item->decreaseQuality(2);
        }
    }
}
