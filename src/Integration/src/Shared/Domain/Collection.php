<?php

declare(strict_types=1);

namespace O2O\Integration\Shared\Domain;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use Iterator;

abstract class Collection implements Iterator, ArrayAccess, Countable
{
    protected $type;

    protected $items;

    private $position;

    public function __construct(array $items = [])
    {
        $this->position = 0;
        $this->items = $items;
    }

    public function current()
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    public function offsetSet($offset, $item): void
    {
        if (!is_a($item, $this->type)) {
            throw new InvalidArgumentException('The item to set must be instance of "' . $this->type . '"');
        }

        if (is_null($offset)) {
            $this->items[] = $item;
        } else {
            $this->items[$offset] = $item;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count()
    {
        return count($this->items);
    }

    public function add($item)
    {
        if (!is_a($item, $this->type)) {
            throw new InvalidArgumentException('The item to add must be instance of "' . $this->type . '"');
        }

        array_push($this->items, $item);
    }
}
