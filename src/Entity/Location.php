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
     * @ORM\Column(type="datetime_immutable")
     */
    private $locationStartedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $locationEndedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Person::class, mappedBy="location")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class)
     */
    private $address;

    public function __construct()
    {
        $this->person = new ArrayCollection();
    }

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

    public function getLocationStartedAt(): ?\DateTimeImmutable
    {
        return $this->locationStartedAt;
    }

    public function setLocationStartedAt(\DateTimeImmutable $locationStartedAt): self
    {
        $this->locationStartedAt = $locationStartedAt;

        return $this;
    }

    public function getLocationEndedAt(): ?\DateTimeImmutable
    {
        return $this->locationEndedAt;
    }

    public function setLocationEndedAt(?\DateTimeImmutable $locationEndedAt): self
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

    /**
     * @return Collection<int, Person>
     */
    public function getPerson(): Collection
    {
        return $this->person;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->person->contains($person)) {
            $this->person[] = $person;
            $person->addLocation($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->person->removeElement($person)) {
            $person->removeLocation($this);
        }

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
}
