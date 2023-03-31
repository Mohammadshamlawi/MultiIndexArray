<?php

trait MultiIndexer
{
    /**
     * Offset to retrieve.
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (!is_array($offset)) {
            return $this->items[$offset];
        }

        $get = [];
        foreach ($offset as $key) {
            $get[] = $this->items[$key];
        }
        return $get;
    }

    /**
     * Set value at offset.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (func_num_args() === 1 || (is_null($offset) && is_array($value))) {
            foreach ($value as $val) {
                $this->items[] = $val;
            }
            return;
        }

        if (is_array($offset) && is_array($value) && count($offset) === count($value)) {
            $arr = array_combine($offset, $value);
            foreach ($arr as $key => $val) {
                $this->items[$key] = $val;
            }
        } elseif (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Unset value at offset.
     */
    public function offsetUnset(mixed $offset): void
    {
        if (!is_array($offset)) {
            unset($this->items[$offset]);
            return;
        }

        foreach ($offset as $key) {
            unset($this->items[$key]);
        }
    }
}