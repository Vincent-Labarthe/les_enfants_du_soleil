<?php

namespace App\Entity;

use App\Repository\EdsEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EdsEntityRepository::class)
 */
class EdsEntity
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
     * @ORM\ManyToOne(targetEntity=Address::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=EdsEntity::class, inversedBy="edsChildren")
     */
    private $edsParent;

    /**
     * @ORM\OneToMany(targetEntity=EdsEntity::class, mappedBy="edsParent")
     */
    private $edsChildren;

    /**
     * @ORM\ManyToOne(targetEntity=EdsType::class, inversedBy="entity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $edsType;

    /**
     * @ORM\OneToMany(targetEntity=Person::class, mappedBy="edsManage")
     */
    private $manager;

    /**
     * @ORM\OneToMany(targetEntity=Person::class, mappedBy="edsEntity")
     */
    private $people;

    public function __construct()
    {
        $this->manager = new ArrayCollection();
        $this->edsChildren = new ArrayCollection();
        $this->people = new ArrayCollection();
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

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEdsParent(): ?self
    {
        return $this->edsParent;
    }

    public function setEdsParent(?self $edsParent): self
    {
        $this->edsParent = $edsParent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEdsChildren(): Collection
    {
        return $this->edsChildren;
    }

    public function addEdsChild(self $edsChild): self
    {
        if (!$this->edsChildren->contains($edsChild)) {
            $this->edsChildren[] = $edsChild;
            $edsChild->setEdsParent($this);
        }

        return $this;
    }

    public function removeEdsChild(self $edsChild): self
    {
        if ($this->edsChildren->removeElement($edsChild)) {
            // set the owning side to null (unless already changed)
            if ($edsChild->getEdsParent() === $this) {
                $edsChild->setEdsParent(null);
            }
        }

        return $this;
    }

    public function getEdsType(): ?EdsType
    {
        return $this->edsType;
    }

    public function setEdsType(?EdsType $edsType): self
    {
        $this->edsType = $edsType;

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getManager(): Collection
    {
        return $this->manager;
    }

    public function addManager(Person $manager): self
    {
        if (!$this->manager->contains($manager)) {
            $this->manager[] = $manager;
            $manager->setEdsManage($this);
        }

        return $this;
    }

    public function removeManager(Person $manager): self
    {
        if ($this->manager->removeElement($manager)) {
            // set the owning side to null (unless already changed)
            if ($manager->getEdsManage() === $this) {
                $manager->setEdsManage(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people[] = $person;
            $person->setEdsEntity($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->people->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getEdsEntity() === $this) {
                $person->setEdsEntity(null);
            }
        }

        return $this;
    }
}
