<?php

namespace App\Entity;

use App\Repository\HealthEventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HealthEventRepository::class)]
class HealthEvent implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $isDisease;

    #[ORM\Column(type: 'string', length: 255)]
    private $reason;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $diagnosis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $analysis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imagery;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $treatment;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comment;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private $consultationCost;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private $drugsCost;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private $otherCost;

    #[ORM\ManyToOne(targetEntity: Beneficiary::class, inversedBy: 'healthEvent')]
    #[ORM\JoinColumn(nullable: false)]
    private $beneficiary;

    #[ORM\ManyToOne(targetEntity: EventMedicalType::class, inversedBy: 'healthEvent')]
    #[ORM\JoinColumn(nullable: false)]
    private $eventMedicalType;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $eventDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsDisease(): ?bool
    {
        return $this->isDisease;
    }

    public function setIsDisease(?bool $isDisease): ?self
    {
        $this->isDisease = $isDisease;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): ?self
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

    public function getAnalysis(): ?string
    {
        return $this->analysis;
    }

    public function setAnalysis(?string $analysis): self
    {
        $this->analysis = $analysis;

        return $this;
    }

    public function getImagery(): ?string
    {
        return $this->imagery;
    }

    public function setImagery(?string $imagery): self
    {
        $this->imagery = $imagery;

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

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getConsultationCost(): ?string
    {
        return $this->consultationCost;
    }

    public function setConsultationCost(?string $consultationCost): ?self
    {
        $this->consultationCost = $consultationCost;

        return $this;
    }

    public function getDrugsCost(): ?string
    {
        return $this->drugsCost;
    }

    public function setDrugsCost(?string $drugsCost): ?self
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

    public function getBeneficiary(): ?Beneficiary
    {
        return $this->beneficiary;
    }

    public function setBeneficiary(?Beneficiary $beneficiary): self
    {
        $this->beneficiary = $beneficiary;

        return $this;
    }

    public function getEventMedicalType(): ?EventMedicalType
    {
        return $this->eventMedicalType;
    }

    public function setEventMedicalType(?EventMedicalType $eventMedicalType): self
    {
        $this->eventMedicalType = $eventMedicalType;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getEventMedicalType()->getName();
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }
}
