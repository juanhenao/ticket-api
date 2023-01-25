<?php

namespace App\Filter;

use App\DTO\ObjectDTOInterface;

interface ObjectFilterInterface
{
    public function apply(ObjectDTOInterface $dto): ObjectDTOInterface;
}
