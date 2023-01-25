<?php

namespace App\Filter;

use App\DTO\ObjectDTOInterface;

class EventFilter implements ObjectFilterInterface
{

    public function apply(ObjectDTOInterface $dto): ObjectDTOInterface
    {
        // TODO: Implement apply() method.

        return $dto;
    }
}
