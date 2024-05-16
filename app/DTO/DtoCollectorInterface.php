<?php

namespace App\DTO;

interface DtoCollectorInterface
{
    public static function collection(array $data, $meta = null): DtoCollection;
}
