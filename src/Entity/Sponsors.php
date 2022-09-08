<?php

namespace App\Entity;

use App\Repository\SponsorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorsRepository::class)]
class Sponsors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image_url;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tel;

    #[ORM\OneToMany(targetEntity: Sponsorship::class, mappedBy: 'sponsor')]
    private $sponsorships;

    public function __construct()
    {
        $this->sponsorships = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Sponsorship>
     */
    public function getSponsorships(): Collection
    {
        return $this->sponsorships;
    }

    public function addSponsorship(Sponsorship $sponsorship): self
    {
        if (!$this->sponsorships->contains($sponsorship)) {
            $this->sponsorships[] = $sponsorship;
            $sponsorship->setSponsor($this);
        }

        return $this;
    }

    public function removeSponsorship(Sponsorship $sponsorship): self
    {
        if ($this->sponsorships->removeElement($sponsorship)) {
            // set the owning side to null (unless already changed)
            if ($sponsorship->getSponsor() === $this) {
                $sponsorship->setSponsor(null);
            }
        }

        return $this;
    }
}
