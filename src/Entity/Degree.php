<?php

namespace App\Entity;

use App\Repository\DegreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DegreeRepository::class)
 */
class Degree implements \Stringable
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Beneficiary::class, mappedBy="degree")
     */
    private $beneficiary;

    public function __construct()
    {
        $this->beneficiary = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Beneficiary>
     */
    public function getBeneficiary(): Collection
    {
        return $this->beneficiary;
    }

    public function addPerson(Beneficiary $beneficiary): self
    {
        if (!$this->beneficiary->contains($beneficiary)) {
            $this->beneficiary[] = $beneficiary;
            $beneficiary->setDegree($this);
        }

        return $this;
    }

    public function removePerson(Beneficiary $beneficiary): self
    {
        if ($this->beneficiary->removeElement($beneficiary)) {
            // set the owning side to null (unless already changed)
            if ($beneficiary->getDegree() === $this) {
                $beneficiary->setDegree(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->name;
    }
}
