<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endedAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $annualSalary;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="jobs")
     */
    private $person;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startedAt;

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
     * @return mixed
     */
    public function getEndedAt()
    {
        return $this->endedAt;
    }

    /**
     * @param mixed $endedAt
     */
    public function setEndedAt($endedAt): void
    {
        $this->endedAt = $endedAt;
    }

    public function getAnnualSalary(): ?int
    {
        return $this->annualSalary;
    }

    public function setAnnualSalary(int $annualSalary): self
    {
        $this->annualSalary = $annualSalary;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

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
}
