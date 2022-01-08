<?php

namespace Logger\Collection;

use Closure;

class Collection
{
    private array $items;

    public function __construct(?array $items = null)
    {
        $this->items = $items ?? [];
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function set($name, $value)
    {
        $this->items[$name] = $value;
    }

    public function get($name)
    {
        return $this->items[$name] ?? null;
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function map(Closure $closure)
    {
        return array_map($closure, $this->items);
    }

    public function first()
    {
        return array_values($this->items)[0] ?? null;
    }

    public function empty()
    {
        $this->items = [];
    }

    public function filter(Closure $callback): Collection
    {
        return new Collection(array_filter($this->items, $callback));
    }
}