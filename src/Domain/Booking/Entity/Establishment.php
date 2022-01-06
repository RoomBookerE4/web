<?php

namespace App\Domain\Booking\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Establishment
 */
#[ORM\Table(name:"Establishment")]
#[ORM\Entity(repositoryClass: \App\Domain\Booking\Repository\EstablishmentRepository::class)]
class Establishment
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    private $name;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'address', type: 'string', length: 255, nullable: true, options: ['default' => null])]
    private $address = null;

    /**
     * @var \DateTime
     */
    #[ORM\Column(name: 'timeOpen', type: 'datetime', nullable: false)]
    private $timeopen;

    /**
     * @var \DateTime
     */
    #[ORM\Column(name: 'timeClose', type: 'datetime', nullable: false)]
    private $timeclose;

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

    public function getTimeopen(): ?\DateTimeInterface
    {
        return $this->timeopen;
    }

    public function setTimeopen(\DateTimeInterface $timeopen): self
    {
        $this->timeopen = $timeopen;

        return $this;
    }

    public function getTimeclose(): ?\DateTimeInterface
    {
        return $this->timeclose;
    }

    public function setTimeclose(\DateTimeInterface $timeclose): self
    {
        $this->timeclose = $timeclose;

        return $this;
    }


}
