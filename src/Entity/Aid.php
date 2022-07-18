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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
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

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $endedAt): self
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
}
