<?php

namespace App\DTO;

interface DtoCollectionInterface
{
    public function getMeta(): mixed;

    public function getData(): array;
}
