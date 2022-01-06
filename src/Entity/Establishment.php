<?php

namespace App\Entity;

use App\Repository\EstablishmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstablishmentRepository::class)]
class Establishment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $timeOpen;

    #[ORM\Column(type: 'string', length: 255)]
    private $timeClose;

    #[ORM\OneToOne(mappedBy: 'idEstablishment', targetEntity: Room::class, cascade: ['persist', 'remove'])]
    private $room;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTimeOpen(): ?string
    {
        return $this->timeOpen;
    }

    public function setTimeOpen(string $timeOpen): self
    {
        $this->timeOpen = $timeOpen;

        return $this;
    }

    public function getTimeClose(): ?string
    {
        return $this->timeClose;
    }

    public function setTimeClose(string $timeClose): self
    {
        $this->timeClose = $timeClose;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(Room $room): self
    {
        // set the owning side of the relation if necessary
        if ($room->getIdEstablishment() !== $this) {
            $room->setIdEstablishment($this);
        }

        $this->room = $room;

        return $this;
    }
}
