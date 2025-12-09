<?php

declare(strict_types=1);

namespace GildedRose\Item\Application\Service;

use GildedRose\Item;
use GildedRose\ItemFactory;
use GildedRose\Item\Domain\Entity\DomainItem;

/**
 * Este servicio orquesta la actualización de un solo Item.
 */

 class SyncItemQuality
{
    public function sync(Item $item): void
    {
        // Envolvemos el Item en nuestro DomainItem para que los updaters usen métodos como decreaseSellIn() que el Item normal no tiene
        $domainItem = new DomainItem($item);

        // Obtnemos el updater adecuado para el tipo de item
        $updater = ItemFactory::getUpdater($domainItem->name());

        $updater->update($domainItem);
        
    }
}