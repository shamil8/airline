<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalAmount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToOne(targetEntity=Ticket::class, mappedBy="bookingId", cascade={"persist", "remove"})
     */
    private $ticket;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(?float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->isActive;
    }

    public function setStatus(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        // unset the owning side of the relation if necessary
        if ($ticket === null && $this->ticket !== null) {
            $this->ticket->setBookingId(null);
        }

        // set the owning side of the relation if necessary
        if ($ticket !== null && $ticket->getBookingId() !== $this) {
            $ticket->setBookingId($this);
        }

        $this->ticket = $ticket;

        return $this;
    }
}
