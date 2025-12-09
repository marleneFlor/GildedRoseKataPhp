<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Updater;

/*
 * Sulfuras es un item legendario que no cambia su calidad ni su fecha de venta.
 */
use GildedRose\Item\Domain\Entity\DomainItem;

class Sulfuras implements ItemUpdater
{
    public function update(DomainItem $item): void
    {
        // Sulfuras no envejece (no baja SellIn)
        // Sulfuras no cambia de calidad.
    }
}
