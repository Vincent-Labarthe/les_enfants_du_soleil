<?php

namespace App\Entity;

use App\Repository\InterviewReportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterviewReportRepository::class)]
class InterviewReport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $report;

    #[ORM\ManyToOne(targetEntity: Beneficiary::class, inversedBy: 'interviewReports')]
    #[ORM\JoinColumn(nullable: false)]
    private $beneficiary;

    #[ORM\ManyToOne(targetEntity: Employee::class, inversedBy: 'interviewReports')]
    #[ORM\JoinColumn(nullable: false)]
    private $manager;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $eventDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(string $report): self
    {
        $this->report = $report;

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

    public function getManager(): ?Beneficiary
    {
        return $this->manager;
    }

    public function setManager(?Beneficiary $manager): self
    {
        $this->manager = $manager;

        return $this;
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
