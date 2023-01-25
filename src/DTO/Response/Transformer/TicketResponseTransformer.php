<?php

namespace App\DTO\Response\Transformer;

use App\DTO\Response\ObjectDTOInterface;
use App\Entity\Ticket;

class TicketResponseTransformer extends AbstractResponseDtoTransformer
{

    /**
     * @param Ticket $object
     * @return \App\DTO\Response\Ticket
     */
    public function transformFromObject($object): ObjectDTOInterface
    {
        $dto = new \App\DTO\Response\Ticket();

        $dto->setId($object->getId());
        $dto->setBarcode($object->getBarcode());
        $dto->setFirstname($object->getName());
        $dto->setLastname($object->getLastname());

        return $dto;
    }
}
