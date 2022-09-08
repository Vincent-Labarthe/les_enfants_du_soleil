<?php

namespace App\Entity;

use App\Repository\EventMedicalTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventMedicalTypeRepository::class)]
class EventMedicalType implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: HealthEvent::class, mappedBy: 'eventMedicalType')]
    private $healthEvent;

    public function __construct()
    {
        $this->healthEvent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, HealthEvent>
     */
    public function getHealthEvent(): Collection
    {
        return $this->healthEvent;
    }

    public function addHealthEvent(HealthEvent $healthEvent): self
    {
        if (!$this->healthEvent->contains($healthEvent)) {
            $this->healthEvent[] = $healthEvent;
            $healthEvent->setEventMedicalType($this);
        }

        return $this;
    }

    public function removeHealthEvent(HealthEvent $healthEvent): self
    {
        if ($this->healthEvent->removeElement($healthEvent)) {
            // set the owning side to null (unless already changed)
            if ($healthEvent->getEventMedicalType() === $this) {
                $healthEvent->setEventMedicalType(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->name;
    }
}
