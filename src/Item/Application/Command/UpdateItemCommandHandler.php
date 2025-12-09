<?php

declare(strict_types=1);

namespace GildedRose\Item\Application\Command;

use GildedRose\Item\Domain\Repository\ItemRepositoryInterface;
use GildedRose\Item\Domain\ValueObject\Quality;

class UpdateItemCommandHandler
{
    public function __construct(
        private ItemRepositoryInterface $repository
    ) {}

    public function __invoke(UpdateItemCommand $command): void
    {
        $item = $this->repository->getByName($command->name);

        $item->updateManual(
            Quality::create($command->quality),
            $command->sellIn
        );

        $this->repository->save($item);
    }
}