<?php

namespace App\Entity;

use App\Repository\InterviewReportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InterviewReportRepository::class)
 */
class InterviewReport
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
    private $report;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="interviewReports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manager;

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

    public function getManager(): ?Person
    {
        return $this->manager;
    }

    public function setManager(?Person $manager): self
    {
        $this->manager = $manager;

        return $this;
    }
}
