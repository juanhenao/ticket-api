<?php

namespace App\DTO\Response;

use Carbon\Carbon;
use DateTime;

class EventDetailed implements ObjectDTOInterface
{
    private ?int $id;

    private ?string $title;

    private ?DateTime $date;

    private ?string $city;

    /** @var array<Ticket>|null  */
    private ?array $tickets;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    /**
     * @param DateTime|null $date
     */
    public function setDate(?DateTime $date): void
    {
        $this->date =$date;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return Ticket[]|null
     */
    public function getTickets(): ?array
    {
        return $this->tickets;
    }

    /**
     * @param Ticket[]|null $tickets
     */
    public function setTickets(?array $tickets): void
    {
        $this->tickets = $tickets;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
