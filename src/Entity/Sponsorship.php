<?php

namespace App\Entity;

use App\Repository\SponsorshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorshipRepository::class)]
class Sponsorship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $endedAt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $annualAmount;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $paceOfCr;

    #[ORM\ManyToMany(targetEntity: Beneficiary::class, mappedBy: 'sponsorship')]
    private $beneficiary;

    #[ORM\ManyToOne(targetEntity: Sponsors::class, inversedBy: 'sponsorships')]
    #[ORM\JoinColumn(nullable: false)]
    private $sponsor;

    public function __construct()
    {
        $this->beneficiary = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getAnnualAmount(): ?int
    {
        return $this->annualAmount;
    }

    public function setAnnualAmount(?int $annualAmount): self
    {
        $this->annualAmount = $annualAmount;

        return $this;
    }

    public function getpaceOfCr(): ?string
    {
        return $this->paceOfCr;
    }

    public function setpaceOfCr(?string $paceOfCr): self
    {
        $this->paceOfCr = $paceOfCr;

        return $this;
    }

    /**
     * @return Collection<int, Beneficiary>
     */
    public function getBeneficiary(): Collection
    {
        return $this->beneficiary;
    }

    public function addBeneficiary(Beneficiary $beneficiary): self
    {
        if (!$this->beneficiary->contains($beneficiary)) {
            $this->beneficiary[] = $beneficiary;
            $beneficiary->addSponsorship($this);
        }

        return $this;
    }

    public function removeBeneficiary(Beneficiary $beneficiary): self
    {
        if ($this->beneficiary->removeElement($beneficiary)) {
            $beneficiary->removeSponsorship($this);
        }

        return $this;
    }

    public function getSponsor(): ?Sponsors
    {
        return $this->sponsor;
    }

    public function setSponsor(?Sponsors $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }
}
