<?php

namespace App\Domain\Booking\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Booking\Entity\Establishment;

/**
 * Room
 */
#[ORM\Entity(repositoryClass: \App\Domain\Booking\Repository\RoomRepository::class)]
#[ORM\Table(name:"Room")]
#[ORM\Index(fields: ['idEstablishment'])]
class Room
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    private $id;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: true, options: ['default' => null])]
    private $name = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'idNumber', type: 'string', length: 255, nullable: false)]
    private $idNumber;

    /**
     * @var \DateTime|null
     */
    #[ORM\Column(name: 'timeOpen', type: 'datetime', nullable: false, options: ['default' => null])]
    private $timeOpen = null;

    /**
     * @var \DateTime|null
     */
    #[ORM\Column(name: 'timeClose', type: 'datetime', nullable: false, options: ['default' => null])]
    private $timeClose = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'isBookable', type: 'boolean', nullable: false)]
    private $isBookable;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'maxTime', type: 'string', length: 255, nullable: true, options: ['default' => null])]
    private $maxTime = null;

    /**
     * @var Establishment
     */
    #[ORM\ManyToOne(targetEntity: Establishment::class)]
    #[ORM\JoinColumn(name: 'idEstablishment', referencedColumnName: 'id')]
    private $establishment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
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

    public function getTimeOpen(): ?\DateTimeInterface
    {
        return $this->timeOpen;
    }

    public function setTimeOpen(\DateTimeInterface $timeOpen): self
    {
        $this->timeOpen = $timeOpen;

        return $this;
    }

    public function getTimeClose(): ?\DateTimeInterface
    {
        return $this->timeClose;
    }

    public function setTimeClose(\DateTimeInterface $timeClose): self
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

    public function getEstablishment(): ?Establishment
    {
        return $this->establishment;
    }

    public function setEstablishment(?Establishment $establishment): self
    {
        $this->establishment = $establishment;

        return $this;
    }


}
