<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Constants\FlightConstants;
use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post"
 *     },
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete"
 *      },
 *     normalizationContext={"groups"={"flight:read"}},
 *     denormalizationContext={"groups"={"flight:write"}},
 *
 *     attributes={
 *     "pagination_items_per_page"=100,
 *      "formats"={ "json", "html", "csv"={"text/csv"}}
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"flight:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     * @Groups({"flight:read", "flight:write"})
     */
    private $code;

    /**
     * @ORM\Column(type="float")
     * @Groups({"flight:read", "flight:write"})
     */
    private $standardPrice;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"flight:read", "flight:write"})
     */
    private $ticketsCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"flight:read", "flight:write"})
     */
    private $status = FlightConstants::ACTIVE;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"flight:read", "flight:write"})
     */
    private $isFlightTicketSales = true;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="flightId", orphanRemoval=true)
     * @Groups({"flight:read", "flight:write"})
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

    public function getIsFlightTicketSales(): ?bool
    {
        return $this->isFlightTicketSales;
    }

    public function setIsFlightTicketSales(?bool $isFlightTicketSales): self
    {
        $this->isFlightTicketSales = $isFlightTicketSales;

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
