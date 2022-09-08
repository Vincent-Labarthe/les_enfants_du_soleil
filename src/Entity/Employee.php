<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    #[ORM\ManyToMany(targetEntity: EdsEntity::class, inversedBy: 'employees')]
    private $edsEntity;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tel;

    #[ORM\ManyToMany(targetEntity: TrainingInstitution::class, mappedBy: 'employee')]
    private $trainingInstitutions;

    #[ORM\OneToMany(targetEntity: InterviewReport::class, mappedBy: 'manager')]
    private $interviewReports;

    #[ORM\OneToOne(targetEntity: GeneralIdentifier::class, mappedBy: 'employee', cascade: ['persist', 'remove'])]
    private $generalIdentifier;

    public function __construct()
    {
        $this->edsEntity = new ArrayCollection();
        $this->trainingInstitutions = new ArrayCollection();
        $this->interviewReports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, EdsEntity>
     */
    public function getEdsEntity(): Collection
    {
        return $this->edsEntity;
    }

    public function addEdsEntity(EdsEntity $edsEntity): self
    {
        if (!$this->edsEntity->contains($edsEntity)) {
            $this->edsEntity[] = $edsEntity;
        }

        return $this;
    }

    public function removeEdsEntity(EdsEntity $edsEntity): self
    {
        $this->edsEntity->removeElement($edsEntity);

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, TrainingInstitution>
     */
    public function getTrainingInstitutions(): Collection
    {
        return $this->trainingInstitutions;
    }

    public function addTrainingInstitution(TrainingInstitution $trainingInstitution): self
    {
        if (!$this->trainingInstitutions->contains($trainingInstitution)) {
            $this->trainingInstitutions[] = $trainingInstitution;
            $trainingInstitution->addEmployee($this);
        }

        return $this;
    }

    public function removeTrainingInstitution(TrainingInstitution $trainingInstitution): self
    {
        if ($this->trainingInstitutions->removeElement($trainingInstitution)) {
            $trainingInstitution->removeEmployee($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, InterviewReport>
     */
    public function getInterviewReports(): Collection
    {
        return $this->interviewReports;
    }

    public function addInterviewReport(InterviewReport $interviewReport): self
    {
        if (!$this->interviewReports->contains($interviewReport)) {
            $this->interviewReports[] = $interviewReport;
            $interviewReport->setManager($this);
        }

        return $this;
    }

    public function removeInterviewReport(InterviewReport $interviewReport): self
    {
        if ($this->interviewReports->removeElement($interviewReport)) {
            // set the owning side to null (unless already changed)
            if ($interviewReport->getManager() === $this) {
                $interviewReport->setManager(null);
            }
        }

        return $this;
    }

    public function getGeneralIdentifier(): ?GeneralIdentifier
    {
        return $this->generalIdentifier;
    }

    public function setGeneralIdentifier(?GeneralIdentifier $generalIdentifier): self
    {
        // unset the owning side of the relation if necessary
        if ($generalIdentifier === null && $this->generalIdentifier !== null) {
            $this->generalIdentifier->setEmployee(null);
        }

        // set the owning side of the relation if necessary
        if ($generalIdentifier !== null && $generalIdentifier->getEmployee() !== $this) {
            $generalIdentifier->setEmployee($this);
        }

        $this->generalIdentifier = $generalIdentifier;

        return $this;
    }
}
