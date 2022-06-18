<?php

declare(strict_types=1);

namespace SiThuSan\Transcript;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class Collection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    public function __construct(protected array $items)
    {
        //
    }

    public function map(callable $fn): self
    {
        return new static(
            \array_map($fn, $this->items)
        );
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function offsetExists(mixed $key): bool
    {
        return isset($this->items[$key]);
    }

    public function offsetGet(mixed $key): mixed
    {
        return $this->items[$key];
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if (\is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetUnset(mixed $key): void
    {
        unset($this->items[$key]);
    }

    public function jsonSerialize(): mixed
    {
        return $this->items;
    }
}
