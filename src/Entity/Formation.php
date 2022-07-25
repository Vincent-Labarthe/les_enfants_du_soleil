<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
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
    private $specialty;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $result;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $suggestedDirection;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endedAt;

    /**
     * @ORM\ManyToOne(targetEntity=TrainingInstitution::class, inversedBy="formations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trainingInstitution;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="formations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startedAt;

    /**
     * @ORM\ManyToOne(targetEntity=ClassName::class, inversedBy="formation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $className;

    public function __construct()
    {
        $this->person = new ArrayCollection();
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

    public function getEndedAt(): ?\datetime
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\datetime $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getTrainingInstitution(): ?TrainingInstitution
    {
        return $this->trainingInstitution;
    }

    public function setOrganization(?TrainingInstitution $trainingInstitution): self
    {
        $this->trainingInstitution = $trainingInstitution;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getStartedAt(): ?\datetime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\datetime $startedAt): self
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
}
