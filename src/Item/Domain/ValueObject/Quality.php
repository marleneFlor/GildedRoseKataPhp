<?php

declare(strict_types=1);

namespace GildedRose\Item\Domain\ValueObject;

final class Quality
{
    private const MIN = 0;
    private const MAX = 50;
    private const LEGENDARY = 80;

    private function __construct(
        private int $value
    ) {
        $this->ensureIsValid($value);
    }

    public static function create(int $value): self
    {
        return new self($value);
    }

    public static function legendary(): self
    {
        return new self(self::LEGENDARY);
    }

    private function ensureIsValid(int $value): void
    {
        if ($value < self::MIN || $value > self::LEGENDARY) {
            throw new \InvalidArgumentException("Invalid Quality value: {$value}");
        }
    }

    public function increase(int $amount = 1): self
    {
        $new = min(self::MAX, $this->value + $amount);
        return new self($new);
    }

    public function decrease(int $amount = 1): self
    {
        $new = max(self::MIN, $this->value - $amount);
        return new self($new);
    }

    public function dropToZero(): self
    {
        return new self(self::MIN);
    }

    public function value(): int
    {
        return $this->value;
    }
}
