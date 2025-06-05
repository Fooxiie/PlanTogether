<?php

namespace App\Entity;

use App\Repository\AvailabilityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvailabilityRepository::class)]
class Availability
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Participant::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Participant $participant;

    #[ORM\ManyToOne(targetEntity: PollSlot::class)]
    #[ORM\JoinColumn(nullable: false)]
    private PollSlot $slot;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParticipant(): Participant
    {
        return $this->participant;
    }

    public function setParticipant(Participant $participant): self
    {
        $this->participant = $participant;
        return $this;
    }

    public function getSlot(): PollSlot
    {
        return $this->slot;
    }

    public function setSlot(PollSlot $slot): self
    {
        $this->slot = $slot;
        return $this;
    }
}
