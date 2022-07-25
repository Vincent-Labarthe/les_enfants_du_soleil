<?php

namespace App\Entity;

use App\Repository\EdsTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EdsTypeRepository::class)
 */
class EdsType
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
     * @ORM\OneToMany(targetEntity=EdsEntity::class, mappedBy="edsType")
     */
    private $entity;

    public function __construct()
    {
        $this->entity = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, EdsEntity>
     */
    public function getEntity(): Collection
    {
        return $this->entity;
    }

    public function addEntity(EdsEntity $entity): self
    {
        if (!$this->entity->contains($entity)) {
            $this->entity[] = $entity;
            $entity->setEdsType($this);
        }

        return $this;
    }

    public function removeEntity(EdsEntity $entity): self
    {
        if ($this->entity->removeElement($entity)) {
            // set the owning side to null (unless already changed)
            if ($entity->getEdsType() === $this) {
                $entity->setEdsType(null);
            }
        }

        return $this;
    }
}
