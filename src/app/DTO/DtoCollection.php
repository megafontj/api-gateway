<?php

namespace App\DTO;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;

class DtoCollection implements DtoCollectionInterface
{
    public function __construct(
        private array $data,
        private mixed $meta
    )
    {
    }

    public function getMeta(): mixed
    {
        return $this->meta;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function toArray()
    {
        return $this->data;
    }
}
