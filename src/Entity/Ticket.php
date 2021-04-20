<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $seat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passengerName;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $phone;

    /**
     * @ORM\OneToOne(targetEntity=Booking::class, inversedBy="ticket", cascade={"persist", "remove"})
     */
    private $bookingId;

    /**
     * @ORM\ManyToOne(targetEntity=Flight::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flightId;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $passengerEmail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeat(): ?string
    {
        return $this->seat;
    }

    public function setSeat(string $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getPassengerName(): ?string
    {
        return $this->passengerName;
    }

    public function setPassengerName(string $passengerName): self
    {
        $this->passengerName = $passengerName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBookingId(): ?Booking
    {
        return $this->bookingId;
    }

    public function setBookingId(?Booking $bookingId): self
    {
        $this->bookingId = $bookingId;

        return $this;
    }

    public function getFlightId(): ?Flight
    {
        return $this->flightId;
    }

    public function setFlightId(?Flight $flightId): self
    {
        $this->flightId = $flightId;

        return $this;
    }

    public function getPassengerEmail(): ?string
    {
        return $this->passengerEmail;
    }

    public function setPassengerEmail(?string $passengerEmail): self
    {
        $this->passengerEmail = $passengerEmail;

        return $this;
    }
}
