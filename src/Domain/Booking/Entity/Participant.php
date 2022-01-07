<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Auth\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\Booking\Entity\Reservation;

/**
 * Participant
 */
#[ORM\Entity(repositoryClass: \App\Domain\Booking\Repository\ParticipantRepository::class)]
#[ORM\Table(name:"Participant")]
#[ORM\Index(columns: ['idUser', 'idReservation'])]
class Participant
{
    /**
     * @var int
     *
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    private $id;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'isInvitation', type: 'boolean', nullable: false)]
    private $isInvitation;

    /**
     * @var string
     * 
     * Accepted => 'accepted';
     * Rejected => 'rejected';
     * Pending => 'pending';
     */
    #[ORM\Column(name: 'invitationStatus', type: 'string', length: 255, nullable: false)]
    private $invitationStatus;

    /**
     * @var Reservation
     */
    #[ORM\ManyToOne(targetEntity: Reservation::class)]
    #[ORM\JoinColumn(name: 'idReservation', referencedColumnName: 'id')]
    private $reservation;

    /**
     * @var User
     *
     */
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'idUser', referencedColumnName: 'id')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsInvitation(): ?bool
    {
        return $this->isInvitation;
    }

    public function setIsInvitation(bool $isInvitation): self
    {
        $this->isInvitation = $isInvitation;

        return $this;
    }

    public function getInvitationStatus(): ?string
    {
        return $this->invitationStatus;
    }

    public function setInvitationStatus(string $invitationStatus): self
    {
        $this->invitationStatus = $invitationStatus;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
