<?php

namespace App\Entity;

use App\Repository\PollSlotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PollSlotRepository::class)]
class PollSlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Poll::class, inversedBy: 'slots')]
    #[ORM\JoinColumn(nullable: false)]
    private Poll $poll;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $start;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoll(): Poll
    {
        return $this->poll;
    }

    public function setPoll(Poll $poll): self
    {
        $this->poll = $poll;
        return $this;
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->start;
    }

    public function setStart(\DateTimeImmutable $start): self
    {
        $this->start = $start;
        return $this;
    }

    public function getEnd(): \DateTimeImmutable
    {
        return $this->end;
    }

    public function setEnd(\DateTimeImmutable $end): self
    {
        $this->end = $end;
        return $this;
    }
}
