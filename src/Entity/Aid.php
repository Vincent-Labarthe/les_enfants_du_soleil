<?php

namespace App\Entity;

use App\Repository\AidRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AidRepository::class)
 */
class Aid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $annualAmount;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="aid")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startedAt;

    /**
     * @ORM\ManyToOne(targetEntity=AidType::class, inversedBy="aid")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aidType;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnnualAmount(): ?int
    {
        return $this->annualAmount;
    }

    public function setAnnualAmount(?int $annualAmount): self
    {
        $this->annualAmount = $annualAmount;

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

    public function getAidType(): ?AidType
    {
        return $this->aidType;
    }

    public function setAidType(?AidType $aidType): self
    {
        $this->aidType = $aidType;

        return $this;
    }

    public function __toString()
    {
        return $this->aidType->getCategory() . ' ' . $this->aidType->getDescription();
    }
}
