<?php

namespace App\Entity;

use App\Repository\HealthEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HealthEventRepository::class)
 */
class HealthEvent
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
     * @ORM\Column(type="boolean")
     */
    private $isDisease;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reason;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diagnosis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imaging;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $treatment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $consultationCost;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $drugsCost;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $otherCost;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="healthEvent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

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

    public function isIsDisease(): ?bool
    {
        return $this->isDisease;
    }

    public function setIsDisease(bool $isDisease): self
    {
        $this->isDisease = $isDisease;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getDiagnosis(): ?string
    {
        return $this->diagnosis;
    }

    public function setDiagnosis(?string $diagnosis): self
    {
        $this->diagnosis = $diagnosis;

        return $this;
    }

    public function getImaging(): ?string
    {
        return $this->imaging;
    }

    public function setImaging(?string $imaging): self
    {
        $this->imaging = $imaging;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(?string $treatment): self
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getConsultationCost(): ?string
    {
        return $this->consultationCost;
    }

    public function setConsultationCost(?string $consultationCost): self
    {
        $this->consultationCost = $consultationCost;

        return $this;
    }

    public function getDrugsCost(): ?string
    {
        return $this->drugsCost;
    }

    public function setDrugsCost(string $drugsCost): self
    {
        $this->drugsCost = $drugsCost;

        return $this;
    }

    public function getOtherCost(): ?string
    {
        return $this->otherCost;
    }

    public function setOtherCost(?string $otherCost): self
    {
        $this->otherCost = $otherCost;

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
}
