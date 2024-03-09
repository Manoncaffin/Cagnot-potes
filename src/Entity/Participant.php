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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: Campaign::class, inversedBy: 'participants')]
    private Collection $Campaign;

    #[ORM\OneToMany(targetEntity: Payment::class, mappedBy: 'participant')]
    private Collection $amount;

    public function __construct()
    {
        $this->Campaign = new ArrayCollection();
        $this->amount = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Campaign>
     */
    public function getCampaign(): Collection
    {
        return $this->Campaign;
    }

    public function addCampaign(Campaign $campaign): static
    {
        if (!$this->Campaign->contains($campaign)) {
            $this->Campaign->add($campaign);
        }

        return $this;
    }

    public function removeCampaign(Campaign $campaign): static
    {
        $this->Campaign->removeElement($campaign);

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getAmount(): Collection
    {
        return $this->amount;
    }

    public function addAmount(Payment $amount): static
    {
        if (!$this->amount->contains($amount)) {
            $this->amount->add($amount);
            $amount->setParticipant($this);
        }

        return $this;
    }

    public function removeAmount(Payment $amount): static
    {
        if ($this->amount->removeElement($amount)) {
            // set the owning side to null (unless already changed)
            if ($amount->getParticipant() === $this) {
                $amount->setParticipant(null);
            }
        }

        return $this;
    }
}
