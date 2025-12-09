<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Updater;

/**
 * Backstage Pass aumenta su calidad con el tiempo.
 * Faltando 10 días para el concierto aumenta 2 veces más rápido.
 * Faltando 5 días para el concierto aumenta 3 veces más rápido.
 * Después de la fecha de venta, la calidad cae a 0.
 */

use GildedRose\Item\Domain\Entity\DomainItem;

 class BackstagePass implements ItemUpdater
 {
     public function update(DomainItem $item): void
     {
         $item->decreaseSellIn();
         $item->increaseQuality();
 
         if ($item->sellIn() < 10) {
             $item->increaseQuality();
         }
 
         if ($item->sellIn() < 5) {
             $item->increaseQuality();
         }
 
         if ($item->sellIn() < 0) {
             $item->dropQualityToZero();
         }
     }
 }
