<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Updater;

use GildedRose\Item\Domain\Entity\DomainItem;

interface ItemUpdater
{
    public function update(DomainItem $item): void;
}