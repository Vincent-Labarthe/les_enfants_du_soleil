<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $endedAt;

    #[ORM\Column(type: 'integer')]
    private $annualSalary;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $company;

    #[ORM\ManyToOne(targetEntity: Beneficiary::class, inversedBy: 'jobs')]
    private $beneficiary;

    #[ORM\Column(type: 'datetime')]
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

    public function setEndedAt(mixed $endedAt): void
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

    public function getBeneficiary(): ?Beneficiary
    {
        return $this->beneficiary;
    }

    public function setBeneficiary(?Beneficiary $beneficiary): self
    {
        $this->beneficiary = $beneficiary;

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
}
