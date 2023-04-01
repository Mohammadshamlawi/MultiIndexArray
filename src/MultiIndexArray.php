<?php

namespace Moh\MultiIndexArray;

use ArrayAccess;
use Countable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @implements ArrayAccess<TKey, TValue>
 */
class MultiIndexArray implements Countable, ArrayAccess
{
    use MultiIndexer;

    /**
     * The items contained in the Array.
     *
     * @var array<TKey, TValue>
     */
    protected array $items = [];

    public function __construct(mixed $items = [])
    {
        if (is_array($items)) {
            $this->items = $items;
            return;
        }
        $this->items = [$items];
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Whether an offset exists.
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }
}