<?php

namespace App\Entity;

use App\Repository\BeneficiaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BeneficiaryRepository::class)]
#[UniqueEntity('email')]
class Beneficiary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['beneficiary'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255, unique: true,nullable: true)]
    #[Assert\Email]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $sexe;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['beneficiary'])]
    private $dateOfBirth;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\File(mimeTypes: ['image/jpeg', 'image/png'])]
    private $imageUrl;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $supportStartedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $supportEndedAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tel;

    #[ORM\OneToMany(targetEntity: BehaviorEvent::class, mappedBy: 'beneficiary', orphanRemoval: true)]
    private $behaviorEvent;

    #[ORM\ManyToMany(targetEntity: Sponsorship::class, inversedBy: 'beneficiary')]
    private $sponsorship;

    #[ORM\OneToMany(targetEntity: Sponsorship::class, mappedBy: 'sponsor')]
    private $sponsorships;

    #[ORM\OneToMany(targetEntity: HealthEvent::class, mappedBy: 'beneficiary')]
    private $healthEvent;

    #[ORM\OneToMany(targetEntity: Aid::class, mappedBy: 'beneficiary')]
    private $aid;

    #[ORM\OneToMany(targetEntity: Job::class, mappedBy: 'beneficiary')]
    private $jobs;

    #[ORM\ManyToOne(targetEntity: Origin::class, inversedBy: 'beneficiary')]
    #[ORM\JoinColumn(nullable: false)]
    private $origin;

    #[ORM\ManyToOne(targetEntity: SchoolLevel::class, inversedBy: 'beneficiary')]
    private $schoolLevel;

    #[ORM\ManyToOne(targetEntity: Degree::class, inversedBy: 'beneficiary')]
    private $degree;

    #[ORM\ManyToOne(targetEntity: TrainingInstitution::class, inversedBy: 'people')]
    private $trainingInstitution;

    #[ORM\OneToMany(targetEntity: InterviewReport::class, mappedBy: 'beneficiary')]
    private $interviewReports;

    #[ORM\OneToMany(targetEntity: InterviewReport::class, mappedBy: 'manager')]
    private $interviewReportsManager;

    #[ORM\OneToOne(targetEntity: GeneralIdentifier::class, mappedBy: 'beneficiary', cascade: ['persist', 'remove'])]
    private $generalIdentifier;

    #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: 'beneficiaries')]
    private $address;

    #[ORM\OneToMany(mappedBy: 'beneficiary', targetEntity: BeneficiaryEdsEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\OrderBy(['id' => 'DESC'])]
    private Collection $edsEntity;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'student')]
    #[ORM\OrderBy(['id' => 'DESC'])]
    private Collection $formations;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $refOrdonnance = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\File(mimeTypes: ['application/pdf', 'application/x-pdf','image/jpeg', 'image/png'])]

    private ?string $birthCertificate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $plannedCareer = null;

    #[ORM\Column(nullable: true)]
    private ?bool $lifeProject = null;

    #[ORM\ManyToMany(targetEntity: FamilyRelation::class, inversedBy: 'beneficiaries')]
    private Collection $familyRelation;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $internRef = null;

    public function __construct()
    {
        $this->behaviorEvent = new ArrayCollection();
        $this->sponsorship = new ArrayCollection();
        $this->sponsorships = new ArrayCollection();
        $this->healthEvent = new ArrayCollection();
        $this->aid = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->interviewReports = new ArrayCollection();
        $this->edsEntity = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->familyRelation = new ArrayCollection();
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
            $behaviorEvent->setBeneficiary($this);
        }

        return $this;
    }

    public function removeBehaviorEvent(BehaviorEvent $behaviorEvent): self
    {
        if ($this->behaviorEvent->removeElement($behaviorEvent)) {
            // set the owning side to null (unless already changed)
            if ($behaviorEvent->getBeneficiary() === $this) {
                $behaviorEvent->setBeneficiary(null);
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
            $healthEvent->setBeneficiary($this);
        }

        return $this;
    }

    public function removeHealthEvent(HealthEvent $healthEvent): self
    {
        if ($this->healthEvent->removeElement($healthEvent)) {
            // set the owning side to null (unless already changed)
            if ($healthEvent->getBeneficiary() === $this) {
                $healthEvent->setBeneficiary(null);
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
            $aid->setBeneficiary($this);
        }

        return $this;
    }

    public function removeAid(Aid $aid): self
    {
        if ($this->aid->removeElement($aid)) {
            // set the owning side to null (unless already changed)
            if ($aid->getBeneficiary() === $this) {
                $aid->setBeneficiary(null);
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
            $job->setBeneficiary($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getBeneficiary() === $this) {
                $job->setBeneficiary(null);
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

    public function getTrainingInstitution(): ?TrainingInstitution
    {
        return $this->trainingInstitution;
    }

    public function setTrainingInstitution(?TrainingInstitution $trainingInstitution): self
    {
        $this->trainingInstitution = $trainingInstitution;

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
            $interviewReport->setBeneficiary($this);
        }

        return $this;
    }

    public function removeInterviewReport(InterviewReport $interviewReport): self
    {
        if ($this->interviewReports->removeElement($interviewReport)) {
            // set the owning side to null (unless already changed)
            if ($interviewReport->getBeneficiary() === $this) {
                $interviewReport->setBeneficiary(null);
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
            $this->generalIdentifier->setBeneficiary(null);
        }

        // set the owning side of the relation if necessary
        if ($generalIdentifier !== null && $generalIdentifier->getBeneficiary() !== $this) {
            $generalIdentifier->setBeneficiary($this);
        }

        $this->generalIdentifier = $generalIdentifier;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function __toString()
    {
        return $this->getFirstName().' '.$this->getLastName();
    }

    /**
     * @return Collection<int, BeneficiaryEdsEntity>
     */
    public function getEdsEntity(): Collection
    {
        return $this->edsEntity;
    }

    public function addEdsEntity(BeneficiaryEdsEntity $edsEntity): self
    {
        if (!$this->edsEntity->contains($edsEntity)) {
            $this->edsEntity->add($edsEntity);
            $edsEntity->setBeneficiary($this);
        }

        return $this;
    }

    public function removeEdsEntity(BeneficiaryEdsEntity $edsEntity): self
    {
        if ($this->edsEntity->removeElement($edsEntity)) {
            // set the owning side to null (unless already changed)
            if ($edsEntity->getBeneficiary() === $this) {
                $edsEntity->setBeneficiary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->addStudent($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeStudent($this);
        }

        return $this;
    }

    public function getRefOrdonnance(): ?string
    {
        return $this->refOrdonnance;
    }

    public function setRefOrdonnance(?string $refOrdonnance): self
    {
        $this->refOrdonnance = $refOrdonnance;

        return $this;
    }

    public function getBirthCertificate(): ?string
    {
        return $this->birthCertificate;
    }

    public function setBirthCertificate(?string $birthCertificate): self
    {
        $this->birthCertificate = $birthCertificate;

        return $this;
    }

    public function getPlannedCareer(): ?string
    {
        return $this->plannedCareer;
    }

    public function setPlannedCareer(?string $plannedCareer): self
    {
        $this->plannedCareer = $plannedCareer;

        return $this;
    }

    public function isLifeProject(): ?bool
    {
        return $this->lifeProject;
    }

    public function setLifeProject(?bool $lifeProject): self
    {
        $this->lifeProject = $lifeProject;

        return $this;
    }

    /**
     * @return Collection<int, FamilyRelation>
     */
    public function getFamilyRelation(): Collection
    {
        return $this->familyRelation;
    }

    public function addFamilyRelation(FamilyRelation $familyRelation): self
    {
        if (!$this->familyRelation->contains($familyRelation)) {
            $this->familyRelation->add($familyRelation);
        }

        return $this;
    }

    public function removeFamilyRelation(FamilyRelation $familyRelation): self
    {
        $this->familyRelation->removeElement($familyRelation);

        return $this;
    }

    public function getInternRef(): ?string
    {
        return $this->internRef;
    }

    public function setInternRef(?string $internRef): self
    {
        $this->internRef = $internRef;

        return $this;
    }
}
