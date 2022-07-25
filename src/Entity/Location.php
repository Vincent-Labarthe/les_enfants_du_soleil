<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCurrentLocation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $locationStartedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $locationEndedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class)
     */
    private $address;
    /**
     * @ORM\OneToOne(targetEntity=Person::class, inversedBy="location", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity=EdsEntity::class, inversedBy="locations")
     */
    private $edsEntity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsCurrentLocation(): ?bool
    {
        return $this->isCurrentLocation;
    }

    public function setIsCurrentLocation(bool $isCurrentLocation): self
    {
        $this->isCurrentLocation = $isCurrentLocation;

        return $this;
    }

    public function getLocationStartedAt(): ?\datetime
    {
        return $this->locationStartedAt;
    }

    public function setLocationStartedAt(\datetime $locationStartedAt): self
    {
        $this->locationStartedAt = $locationStartedAt;

        return $this;
    }

    public function getLocationEndedAt(): ?\datetime
    {
        return $this->locationEndedAt;
    }

    public function setLocationEndedAt(?\datetime $locationEndedAt): self
    {
        $this->locationEndedAt = $locationEndedAt;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getEdsEntity(): ?EdsEntity
    {
        return $this->edsEntity;
    }

    public function setEdsEntity(?EdsEntity $edsEntity): self
    {
        $this->edsEntity = $edsEntity;

        return $this;
    }
}
