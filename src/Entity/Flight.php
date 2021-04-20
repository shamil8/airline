<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $code;

    /**
     * @ORM\Column(type="float")
     */
    private $standardPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $ticketsCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ifFlightTicketSales;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="flightId", orphanRemoval=true)
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getStandardPrice(): ?float
    {
        return $this->standardPrice;
    }

    public function setStandardPrice(float $standardPrice): self
    {
        $this->standardPrice = $standardPrice;

        return $this;
    }

    public function getTicketsCount(): ?int
    {
        return $this->ticketsCount;
    }

    public function setTicketsCount(int $ticketsCount): self
    {
        $this->ticketsCount = $ticketsCount;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIfFlightTicketSales(): ?bool
    {
        return $this->ifFlightTicketSales;
    }

    public function setIfFlightTicketSales(?bool $ifFlightTicketSales): self
    {
        $this->ifFlightTicketSales = $ifFlightTicketSales;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setFlightId($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getFlightId() === $this) {
                $ticket->setFlightId(null);
            }
        }

        return $this;
    }
}
