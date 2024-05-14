<?php

namespace App\Services;

use ArrayAccess;
use Psr\Http\Message\ResponseInterface;

final class ApiResponse implements ArrayAccess
{
    private array $data;

    public function __construct(ResponseInterface $response)
    {
        $this->data = json_decode($response->getBody(), true);
    }

    public function getData(): array
    {
        return $this->data['data'] ?? $this->data;
    }

    public function getMeta(): array
    {
        return $this->data['meta'] ?? array_diff_key($this->data, array_flip(['data']));
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->getData()[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->getData()[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->getData()[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->getData()[$offset]);
    }
}
