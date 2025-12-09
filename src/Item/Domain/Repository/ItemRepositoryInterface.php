<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\Repository;

use GildedRose\Item\Domain\Entity\DomainItem;
use GildedRose\Item\Application\Exception\ItemNotFoundException;

interface ItemRepositoryInterface
{
    public function save(DomainItem $item): void;

    public function create(DomainItem $item): void;

    /**
     * @throws ItemNotFoundException
     */
    public function getByName(string $name): DomainItem;
}