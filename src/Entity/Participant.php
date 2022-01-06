<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'participant', targetEntity: Reservation::class)]
    private $idReservation;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'participants')]
    private $idUser;

    #[ORM\Column(type: 'boolean')]
    private $isInvitation;

    #[ORM\Column(type: 'string', length: 255)]
    private $invitationStatus;

    public function __construct()
    {
        $this->idReservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getIdReservation(): Collection
    {
        return $this->idReservation;
    }

    public function addIdReservation(Reservation $idReservation): self
    {
        if (!$this->idReservation->contains($idReservation)) {
            $this->idReservation[] = $idReservation;
            $idReservation->setParticipant($this);
        }

        return $this;
    }

    public function removeIdReservation(Reservation $idReservation): self
    {
        if ($this->idReservation->removeElement($idReservation)) {
            // set the owning side to null (unless already changed)
            if ($idReservation->getParticipant() === $this) {
                $idReservation->setParticipant(null);
            }
        }

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
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
}
