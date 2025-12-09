<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Updater;

/**
 * Item estándar disminuye su calidad con el tiempo.
 * Después de la fecha de venta, disminuye el doble.
 */

 use GildedRose\Item\Domain\Entity\DomainItem;

 class StandardItem implements ItemUpdater
 {
     public function update(DomainItem $item): void
     {
         $item->decreaseSellIn();
         $item->decreaseQuality();
 
         if ($item->sellIn() < 0) {
             $item->decreaseQuality();
         }
     }
 }
