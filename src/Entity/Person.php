<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"person"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"person"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"person"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"person"})
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $familyRelation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $supportStartedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $supportEndedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=BehaviorEvent::class, mappedBy="person", orphanRemoval=true)
     */
    private $behaviorEvent;

    /**
     * @ORM\ManyToMany(targetEntity=Sponsorship::class, inversedBy="beneficiary")
     */
    private $sponsorship;

    /**
     * @ORM\OneToMany(targetEntity=Sponsorship::class, mappedBy="sponsor")
     */
    private $sponsorships;

    /**
     * @ORM\OneToMany(targetEntity=HealthEvent::class, mappedBy="person")
     */
    private $healthEvent;

    /**
     * @ORM\OneToMany(targetEntity=Aid::class, mappedBy="person")
     */
    private $aid;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="person")
     */
    private $jobs;

    /**
     * @ORM\ManyToOne(targetEntity=Origin::class, inversedBy="person")
     * @ORM\JoinColumn(nullable=false)
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity=SchoolLevel::class, inversedBy="person")
     */
    private $schoolLevel;

    /**
     * @ORM\ManyToOne(targetEntity=Degree::class, inversedBy="person")
     */
    private $degree;

    /**
     * @ORM\ManyToOne(targetEntity=EdsEntity::class, inversedBy="manager")
     */
    private $edsManage;

    /**
     * @ORM\OneToOne(targetEntity=TrainingInstitution::class, inversedBy="correspondant", cascade={"persist", "remove"})
     */
    private $correspondantTrainingInstitution;

    /**
     * @ORM\ManyToOne(targetEntity=TrainingInstitution::class, inversedBy="people")
     */
    private $trainingInstitution;

    /**
     * @ORM\OneToOne(targetEntity=Formation::class, mappedBy="student", cascade={"persist", "remove"})
     */
    private $formation;

    /**
     * @ORM\OneToMany(targetEntity=InterviewReport::class, mappedBy="person")
     */
    private $interviewReports;

    /**
     * @ORM\OneToMany(targetEntity=InterviewReport::class, mappedBy="manager")
     */
    private $interviewReportsManager;

    /**
     * @ORM\ManyToOne(targetEntity=EdsEntity::class, inversedBy="people")
     */
    private $edsEntity;

    public function __construct()
    {
        $this->behaviorEvent = new ArrayCollection();
        $this->sponsorship = new ArrayCollection();
        $this->sponsorships = new ArrayCollection();
        $this->healthEvent = new ArrayCollection();
        $this->aid = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->interviewReports = new ArrayCollection();
        $this->interviewReportsManager = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFamilyRelation(): ?string
    {
        return $this->familyRelation;
    }

    public function setFamilyRelation(?string $familyRelation): self
    {
        $this->familyRelation = $familyRelation;

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

    public function getSupportStartedAt(): ?\DateTime
    {
        return $this->supportStartedAt;
    }

    public function setSupportStartedAt(?\DateTime $supportStartedAt): self
    {
        $this->supportStartedAt = $supportStartedAt;

        return $this;
    }

    public function getSupportEndedAt(): ?\DateTime
    {
        return $this->supportEndedAt;
    }

    public function setSupportEndedAt(?\DateTime $supportEndedAt): self
    {
        $this->supportEndedAt = $supportEndedAt;

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
     * @return Collection<int, BehaviorEvent>
     */
    public function getBehaviorEvent(): Collection
    {
        return $this->behaviorEvent;
    }

    public function addBehaviorEvent(BehaviorEvent $behaviorEvent): self
    {
        if (!$this->behaviorEvent->contains($behaviorEvent)) {
            $this->behaviorEvent[] = $behaviorEvent;
            $behaviorEvent->setPerson($this);
        }

        return $this;
    }

    public function removeBehaviorEvent(BehaviorEvent $behaviorEvent): self
    {
        if ($this->behaviorEvent->removeElement($behaviorEvent)) {
            // set the owning side to null (unless already changed)
            if ($behaviorEvent->getPerson() === $this) {
                $behaviorEvent->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sponsorship>
     */
    public function getSponsorship(): Collection
    {
        return $this->sponsorship;
    }

    public function addSponsorship(Sponsorship $sponsorship): self
    {
        if (!$this->sponsorship->contains($sponsorship)) {
            $this->sponsorship[] = $sponsorship;
        }

        return $this;
    }

    public function removeSponsorship(Sponsorship $sponsorship): self
    {
        $this->sponsorship->removeElement($sponsorship);

        return $this;
    }

    /**
     * @return Collection<int, Sponsorship>
     */
    public function getSponsorships(): Collection
    {
        return $this->sponsorships;
    }

    /**
     * @return Collection<int, HealthEvent>
     */
    public function getHealthEvent(): Collection
    {
        return $this->healthEvent;
    }

    public function addHealthEvent(HealthEvent $healthEvent): self
    {
        if (!$this->healthEvent->contains($healthEvent)) {
            $this->healthEvent[] = $healthEvent;
            $healthEvent->setPerson($this);
        }

        return $this;
    }

    public function removeHealthEvent(HealthEvent $healthEvent): self
    {
        if ($this->healthEvent->removeElement($healthEvent)) {
            // set the owning side to null (unless already changed)
            if ($healthEvent->getPerson() === $this) {
                $healthEvent->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Aid>
     */
    public function getAid(): Collection
    {
        return $this->aid;
    }

    public function addAid(Aid $aid): self
    {
        if (!$this->aid->contains($aid)) {
            $this->aid[] = $aid;
            $aid->setPerson($this);
        }

        return $this;
    }

    public function removeAid(Aid $aid): self
    {
        if ($this->aid->removeElement($aid)) {
            // set the owning side to null (unless already changed)
            if ($aid->getPerson() === $this) {
                $aid->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Job>
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setPerson($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getPerson() === $this) {
                $job->setPerson(null);
            }
        }

        return $this;
    }

    public function getOrigin(): ?Origin
    {
        return $this->origin;
    }

    public function setOrigin(?Origin $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getSchoolLevel(): ?SchoolLevel
    {
        return $this->schoolLevel;
    }

    public function setSchoolLevel(?SchoolLevel $schoolLevel): self
    {
        $this->schoolLevel = $schoolLevel;

        return $this;
    }

    public function getDegree(): ?Degree
    {
        return $this->degree;
    }

    public function setDegree(?Degree $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getEdsManage(): ?EdsEntity
    {
        return $this->edsManage;
    }

    public function setEdsManage(?EdsEntity $edsManage): self
    {
        $this->edsManage = $edsManage;

        return $this;
    }

    public function __toString()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getCorrespondantTrainingInstitution(): ?TrainingInstitution
    {
        return $this->correspondantTrainingInstitution;
    }

    public function setCorrespondantTrainingInstitution(?TrainingInstitution $correspondantTrainingInstitution): self
    {
        $this->correspondantTrainingInstitution = $correspondantTrainingInstitution;

        return $this;
    }

    public function getTrainingInstitution(): ?TrainingInstitution
    {
        return $this->trainingInstitution;
    }

    public function setTrainingInstitution(?TrainingInstitution $trainingInstitution): self
    {
        $this->trainingInstitution = $trainingInstitution;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(Formation $formation): self
    {
        // set the owning side of the relation if necessary
        if ($formation->getStudent() !== $this) {
            $formation->setStudent($this);
        }

        $this->formation = $formation;

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
            $interviewReport->setPerson($this);
        }

        return $this;
    }

    public function removeInterviewReport(InterviewReport $interviewReport): self
    {
        if ($this->interviewReports->removeElement($interviewReport)) {
            // set the owning side to null (unless already changed)
            if ($interviewReport->getPerson() === $this) {
                $interviewReport->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InterviewReport>
     */
    public function getInterviewReportsManager(): Collection
    {
        return $this->interviewReportsManager;
    }

    public function addInterviewReportsManager(InterviewReport $interviewReportsManager): self
    {
        if (!$this->interviewReportsManager->contains($interviewReportsManager)) {
            $this->interviewReportsManager[] = $interviewReportsManager;
            $interviewReportsManager->setManager($this);
        }

        return $this;
    }

    public function removeInterviewReportsManager(InterviewReport $interviewReportsManager): self
    {
        if ($this->interviewReportsManager->removeElement($interviewReportsManager)) {
            // set the owning side to null (unless already changed)
            if ($interviewReportsManager->getManager() === $this) {
                $interviewReportsManager->setManager(null);
            }
        }

        return $this;
    }

    public function getEdsEntity(): ?EdsEntity
    {
        return $this->edsEntity;
    }

    public function setEdsEntity(?EdsEntity $edsEntity): self
    {
        $this->edsEntity = $edsEntity;

        return $this;
    }
}
