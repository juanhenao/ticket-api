<?php

namespace App\DTO\Response\Transformer;

use App\DTO\Response\EventDetailed;
use App\DTO\Response\ObjectDTOInterface;
use App\Entity\Event;

class EventDetailedResponseTransformer extends AbstractResponseDtoTransformer
{

    public function __construct(private TicketResponseTransformer $ticketResponseTransformer)
    {
        $this->ticketResponseTransformer = new TicketResponseTransformer();
    }

    /**
     * @param Event $object
     * @return EventDetailed
     */
    public function transformFromObject($object): ObjectDTOInterface
    {
        $dto = new EventDetailed();

        $dto->setId($object->getId());
        $dto->setTitle($object->getTitle());
        $dto->setCity($object->getCity());
        $dto->setDate($object->getDate());
        $dto->setTickets($this->ticketResponseTransformer->transformFromObjects($object->getTickets()));

        return $dto;
    }

}
