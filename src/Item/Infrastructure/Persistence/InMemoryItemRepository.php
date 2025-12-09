<?php

declare(strict_types=1);

namespace GildedRose\Item\Infrastructure\Persistence;

use GildedRose\Item;
use GildedRose\Item\Application\Exception\ItemNotFoundException;
use GildedRose\Item\Domain\Entity\DomainItem;
use GildedRose\Item\Domain\Repository\ItemRepositoryInterface;

class InMemoryItemRepository implements ItemRepositoryInterface
{
    /** * Simulamos la base de datos con un array asociativo 
     * donde la clave es el nombre del item.
     * @var array<string, Item> 
     */
    private array $items = [];

    /**
     * @param Item[] $initialItems Carga inicial (opcional) para tests o arranque
     */
    public function __construct(array $initialItems = [])
    {
        foreach ($initialItems as $item) {
            // Indexamos por nombre para búsquedas rápidas
            $this->items[$item->name] = $item;
        }
    }

    /**
     * Busca por nombre y devuelve YA convertido a Dominio.
     * Esto mantiene tus Handlers limpios.
     */
    public function getByName(string $name): DomainItem
    {
        if (!isset($this->items[$name])) {
            throw ItemNotFoundException::withName($name);
        }

        // HIDRATACIÓN: Convertimos el dato crudo (legacy) a Entidad de Dominio
        return new DomainItem($this->items[$name]);
    }

    /**
     * Guarda (o actualiza) un DomainItem.
     */
    public function save(DomainItem $item): void
    {
        // DESHIDRATACIÓN: Extraemos el objeto legacy para guardarlo en el array.
        // Asegúrate de tener el método publico getLegacyItem() en tu DomainItem.
        $legacyItem = $item->getLegacyItem();
        
        $this->items[$legacyItem->name] = $legacyItem;
    }

    /**
     * Crea un nuevo ítem en la colección.
     * (En memoria es lo mismo que save, pero semánticamente distinto).
     */
    public function create(DomainItem $item): void
    {
        $this->save($item);
    }

    /**
     * Devuelve todos los items como objetos de Dominio.
     * @return DomainItem[]
     */
    public function findAll(): array
    {
        $domainItems = [];

        foreach ($this->items as $legacyItem) {
            $domainItems[] = new DomainItem($legacyItem);
        }

        return $domainItems;
    }
}