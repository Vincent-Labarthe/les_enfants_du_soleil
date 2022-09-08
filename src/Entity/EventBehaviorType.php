<?php

namespace App\Entity;

use App\Repository\EventBehaviorTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventBehaviorTypeRepository::class)
 */
class EventBehaviorType implements \Stringable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=BehaviorEvent::class, mappedBy="eventBehaviorType")
     */
    private $behaviorEvent;

    public function __construct()
    {
        $this->behaviorEvent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, BehaviorEvent>
     */
    public function getBehaviorEvent(): Collection
    {
        return $this->behaviorEvent;
    }

    public function addBehaviorEvent(BehaviorEvent $behaviorEvent): self
    {
        if (!$this->behaviorEvent->contains($behaviorEvent)) {
            $this->behaviorEvent[] = $behaviorEvent;
            $behaviorEvent->setEventBehaviorType($this);
        }

        return $this;
    }

    public function removeBehaviorEvent(BehaviorEvent $behaviorEvent): self
    {
        if ($this->behaviorEvent->removeElement($behaviorEvent)) {
            // set the owning side to null (unless already changed)
            if ($behaviorEvent->getEventBehaviorType() === $this) {
                $behaviorEvent->setEventBehaviorType(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->type;
    }
}
