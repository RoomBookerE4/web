<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'room', targetEntity: Establishment::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $idEstablishment;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $idNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $timeOpen;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $timeClose;

    #[ORM\Column(type: 'boolean')]
    private $isBookable;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $maxTime;

    #[ORM\OneToOne(mappedBy: 'idRoom', targetEntity: Reservation::class, cascade: ['persist', 'remove'])]
    private $reservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEstablishment(): ?Establishment
    {
        return $this->idEstablishment;
    }

    public function setIdEstablishment(Establishment $idEstablishment): self
    {
        $this->idEstablishment = $idEstablishment;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    public function setIdNumber(string $idNumber): self
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    public function getTimeOpen(): ?string
    {
        return $this->timeOpen;
    }

    public function setTimeOpen(?string $timeOpen): self
    {
        $this->timeOpen = $timeOpen;

        return $this;
    }

    public function getTimeClose(): ?string
    {
        return $this->timeClose;
    }

    public function setTimeClose(?string $timeClose): self
    {
        $this->timeClose = $timeClose;

        return $this;
    }

    public function getIsBookable(): ?bool
    {
        return $this->isBookable;
    }

    public function setIsBookable(bool $isBookable): self
    {
        $this->isBookable = $isBookable;

        return $this;
    }

    public function getMaxTime(): ?string
    {
        return $this->maxTime;
    }

    public function setMaxTime(?string $maxTime): self
    {
        $this->maxTime = $maxTime;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        // unset the owning side of the relation if necessary
        if ($reservation === null && $this->reservation !== null) {
            $this->reservation->setIdRoom(null);
        }

        // set the owning side of the relation if necessary
        if ($reservation !== null && $reservation->getIdRoom() !== $this) {
            $reservation->setIdRoom($this);
        }

        $this->reservation = $reservation;

        return $this;
    }
}
