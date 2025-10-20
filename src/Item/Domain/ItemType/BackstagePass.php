<?php

declare(strict_types=1);

namespace GildedRose\ItemType;

use GildedRose\Item;
use GildedRose\ItemUpdater;

/**
 * Backstage Pass aumenta su calidad con el tiempo.
 * Faltando 10 días para el concierto aumenta 2 veces más rápido.
 * Faltando 5 días para el concierto aumenta 3 veces más rápido.
 * Después de la fecha de venta, la calidad cae a 0.
 */
class BackstagePass extends ItemUpdater
{
    public function updateQuality(): void
    {
        $this->decreaseSellIn();

        if ($this->item->sellIn < 0) {
            $this->decreaseQuality($this->item->quality);
        }

        if ($this->item->sellIn <= 5) {
            $this->increaseQuality(3);
        } elseif ($this->item->sellIn <= 10) {
            $this->increaseQuality(2);
        } else {
            $this->increaseQuality();
        }

    }
}
