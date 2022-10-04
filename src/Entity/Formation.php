<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $specialty;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $result;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $suggestedDirection;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $endedAt;

    #[ORM\ManyToOne(targetEntity: TrainingInstitution::class, inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: true)]
    private $trainingInstitution;

    #[ORM\Column(type: 'datetime')]
    private $startedAt;

    #[ORM\ManyToOne(targetEntity: ClassName::class, inversedBy: 'formation')]
    #[ORM\JoinColumn(nullable: true)]
    private $className;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Beneficiary::class, inversedBy: 'formations')]
    private Collection $student;

    #[ORM\ManyToOne(inversedBy: 'formation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    public function __construct()
    {
        $this->student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialty(): ?string
    {
        return $this->specialty;
    }

    public function setSpecialty(string $specialty): self
    {
        $this->specialty = $specialty;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getSuggestedDirection(): ?string
    {
        return $this->suggestedDirection;
    }

    public function setSuggestedDirection(?string $suggestedDirection): self
    {
        $this->suggestedDirection = $suggestedDirection;

        return $this;
    }

    public function getEndedAt(): ?\DateTime
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTime $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getTrainingInstitution(): ?TrainingInstitution
    {
        return $this->trainingInstitution;
    }

    public function setTrainingInstitution(?TrainingInstitution $trainingInstitution): self
    {
        $this->trainingInstitution = $trainingInstitution;

        return $this;
    }

    public function getStartedAt(): ?\DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getClassName(): ?ClassName
    {
        return $this->className;
    }

    public function setClassName(?ClassName $className): self
    {
        $this->className = $className;

        return $this;
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

    public function __toString(): string
    {
        return (string) $this->name;
    }

    /**
     * @return Collection<int, Beneficiary>
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(Beneficiary $student): self
    {
        if (!$this->student->contains($student)) {
            $this->student->add($student);
        }

        return $this;
    }

    public function removeStudent(Beneficiary $student): self
    {
        $this->student->removeElement($student);

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
