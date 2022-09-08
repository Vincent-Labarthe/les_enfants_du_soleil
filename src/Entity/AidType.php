<?php

namespace App\Entity;

use App\Repository\AidTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AidTypeRepository::class)]
class AidType implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\OneToMany(targetEntity: Aid::class, mappedBy: 'aidType')]
    private $aid;

    public function __construct()
    {
        $this->aid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Aid>
     */
    public function getAid(): Collection
    {
        return $this->aid;
    }

    public function addAid(Aid $aid): self
    {
        if (!$this->aid->contains($aid)) {
            $this->aid[] = $aid;
            $aid->setAidType($this);
        }

        return $this;
    }

    public function removeAid(Aid $aid): self
    {
        if ($this->aid->removeElement($aid)) {
            // set the owning side to null (unless already changed)
            if ($aid->getAidType() === $this) {
                $aid->setAidType(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->category.' '.$this->description;
    }
}
