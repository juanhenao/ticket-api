<?php

namespace App\DTO\Response\Transformer;

use App\DTO\Response\ObjectDTOInterface;
use App\Entity\AbstractEntity;

interface ResponseDtoTransformer
{
    public function transformFromObject(AbstractEntity $object): ObjectDTOInterface;
    public function transformFromObjects(iterable $objects): iterable;

}
