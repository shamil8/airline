<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
 *     normalizationContext={"groups"={"book:read"}},
 *     denormalizationContext={"groups"={"book:write"}},
 *
 *     attributes={
 *     "pagination_items_per_page"=100,
 *      "formats"={ "json", "html", "csv"={"text/csv"}}
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"book:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"book:read", "book:write"})
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"book:read", "book:write"})
     */
    private $totalAmount;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"book:read", "book:write"})
     */
    private $isActive = true;

    /**
     * @ORM\OneToOne(targetEntity=Ticket::class, mappedBy="bookingId", cascade={"persist", "remove"})
     * @Groups({"book:read"})
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
