<?php

namespace App\Entity;

use App\Repository\SchoolLevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolLevelRepository::class)
 */
class SchoolLevel implements \Stringable
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
    private $level;

    /**
     * @ORM\OneToMany(targetEntity=Beneficiary::class, mappedBy="schoolLevel")
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

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

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
            $beneficiary->setSchoolLevel($this);
        }

        return $this;
    }

    public function removePerson(Beneficiary $beneficiary): self
    {
        if ($this->beneficiary->removeElement($beneficiary)) {
            // set the owning side to null (unless already changed)
            if ($beneficiary->getSchoolLevel() === $this) {
                $beneficiary->setSchoolLevel(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->level;
    }
}
