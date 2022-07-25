<?php

namespace App\Entity;

use App\Repository\TrainingInstitutionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingInstitutionRepository::class)
 * @ORM\Table(name="training_institution")
 */
class TrainingInstitution
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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;


    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="trainingInstitution")
     */
    private $formations;

    /**
     * @ORM\OneToOne(targetEntity=Person::class, mappedBy="correspondantTrainingInstitution", cascade={"persist", "remove"})
     */
    private $correspondant;

    /**
     * @ORM\OneToMany(targetEntity=Person::class, mappedBy="trainingInstitution")
     */
    private $people;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

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

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setTrainingInstitution($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getTrainingInstitution() === $this) {
                $formation->setTrainingInstitution(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getCorrespondant(): ?Person
    {
        return $this->correspondant;
    }

    public function setCorrespondant(?Person $correspondant): self
    {
        // unset the owning side of the relation if necessary
        if ($correspondant === null && $this->correspondant !== null) {
            $this->correspondant->setCorrespondantTrainingInstitution(null);
        }

        // set the owning side of the relation if necessary
        if ($correspondant !== null && $correspondant->getCorrespondantTrainingInstitution() !== $this) {
            $correspondant->setCorrespondantTrainingInstitution($this);
        }

        $this->correspondant = $correspondant;

        return $this;
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
            $person->setTrainingInstitution($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->people->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getTrainingInstitution() === $this) {
                $person->setTrainingInstitution(null);
            }
        }

        return $this;
    }
}
