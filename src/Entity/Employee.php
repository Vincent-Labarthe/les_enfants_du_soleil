<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[UniqueEntity('email')]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Assert\Email]
    private $email;

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

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $StartedAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $EndedAt = null;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: EmployeeFunction::class)]
    private Collection $functions;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: Formation::class, orphanRemoval: true)]
    private Collection $formation;

    public function __construct()
    {
        $this->edsEntity = new ArrayCollection();
        $this->trainingInstitutions = new ArrayCollection();
        $this->interviewReports = new ArrayCollection();
        $this->functions = new ArrayCollection();
        $this->formation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->StartedAt;
    }

    public function setStartedAt(\DateTimeInterface $StartedAt): self
    {
        $this->StartedAt = $StartedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->EndedAt;
    }

    public function setEndedAt(?\DateTimeInterface $EndedAt): self
    {
        $this->EndedAt = $EndedAt;

        return $this;
    }

    /**
     * @return Collection<int, EmployeeFunction>
     */
    public function getFunctions(): Collection
    {
        return $this->functions;
    }

    public function addFunction(EmployeeFunction $function): self
    {
        if (!$this->functions->contains($function)) {
            $this->functions->add($function);
            $function->setEmployee($this);
        }

        return $this;
    }

    public function removeFunction(EmployeeFunction $function): self
    {
        if ($this->functions->removeElement($function)) {
            // set the owning side to null (unless already changed)
            if ($function->getEmployee() === $this) {
                $function->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation->add($formation);
            $formation->setEmployee($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formation->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getEmployee() === $this) {
                $formation->setEmployee(null);
            }
        }

        return $this;
    }
}
