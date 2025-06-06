<?php

namespace App\Entity;

use App\Repository\PollRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\PollSlot;

#[ORM\Entity(repositoryClass: PollRepository::class)]
class Poll
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $slug;

    #[ORM\Column(length: 255)]
    private string $organizerName;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $organizerEmail = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $startDate;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $endDate;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $deadline;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, PollSlot>
     */
    #[ORM\OneToMany(mappedBy: 'poll', targetEntity: PollSlot::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $slots;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->slots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getOrganizerName(): string
    {
        return $this->organizerName;
    }

    public function setOrganizerName(string $organizerName): self
    {
        $this->organizerName = $organizerName;
        return $this;
    }

    public function getOrganizerEmail(): ?string
    {
        return $this->organizerEmail;
    }

    public function setOrganizerEmail(?string $organizerEmail): self
    {
        $this->organizerEmail = $organizerEmail;
        return $this;
    }

    public function getStartDate(): \DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeImmutable $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): \DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getDeadline(): \DateTimeImmutable
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeImmutable $deadline): self
    {
        $this->deadline = $deadline;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Collection<int, PollSlot>
     */
    public function getSlots(): Collection
    {
        return $this->slots;
    }

    public function addSlot(PollSlot $slot): self
    {
        if (!$this->slots->contains($slot)) {
            $this->slots[] = $slot;
            $slot->setPoll($this);
        }

        return $this;
    }

    public function removeSlot(PollSlot $slot): self
    {
        if ($this->slots->removeElement($slot)) {
            if ($slot->getPoll() === $this) {
                $slot->setPoll(null);
            }
        }

        return $this;
    }
}
