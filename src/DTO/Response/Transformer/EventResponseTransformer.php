<?php

namespace App\DTO\Response\Transformer;

use App\DTO\Response\ObjectDTOInterface;
use App\Entity\Event;

class EventResponseTransformer extends AbstractResponseDtoTransformer
{

    /**
     * @param Event $object
     * @return \App\DTO\Response\Event
     */
    public function transformFromObject($object): ObjectDTOInterface
    {
        $dto = new \App\DTO\Response\Event();

        $dto->setId($object->getId());
        $dto->setTitle($object->getTitle());
        $dto->setCity($object->getCity());
        $dto->setDate($object->getDate());

        return $dto;
    }

}
