<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currentSiteAttachment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $degree;

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
     * @ORM\Column(type="string", length=255)
     */
    private $lastGradeLevel;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $supportStartedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
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
     * @ORM\OneToOne(targetEntity=Organization::class, mappedBy="correspondent", cascade={"persist", "remove"})
     */
    private $organization;

    /**
     * @ORM\OneToMany(targetEntity=InterviewReport::class, mappedBy="manager")
     */
    private $interviewReports;

    /**
     * @ORM\OneToMany(targetEntity=Aid::class, mappedBy="person")
     */
    private $aid;

    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="person")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="person")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="person")
     */
    private $locations;

    public function __construct()
    {
        $this->behaviorEvent = new ArrayCollection();
        $this->sponsorship = new ArrayCollection();
        $this->sponsorships = new ArrayCollection();
        $this->healthEvent = new ArrayCollection();
        $this->interviewReports = new ArrayCollection();
        $this->aid = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->locations = new ArrayCollection();
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

    public function getCurrentSiteAttachment(): ?string
    {
        return $this->currentSiteAttachment;
    }

    public function setCurrentSiteAttachment(?string $currentSiteAttachment): self
    {
        $this->currentSiteAttachment = $currentSiteAttachment;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(?string $degree): self
    {
        $this->degree = $degree;

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

    public function getLastGradeLevel(): ?string
    {
        return $this->lastGradeLevel;
    }

    public function setLastGradeLevel(string $lastGradeLevel): self
    {
        $this->lastGradeLevel = $lastGradeLevel;

        return $this;
    }

    public function getSupportStartedAt(): ?\DateTimeImmutable
    {
        return $this->supportStartedAt;
    }

    public function setSupportStartedAt(\DateTimeImmutable $supportStartedAt): self
    {
        $this->supportStartedAt = $supportStartedAt;

        return $this;
    }

    public function getSupportEndedAt(): ?\DateTimeImmutable
    {
        return $this->supportEndedAt;
    }

    public function setSupportEndedAt(?\DateTimeImmutable $supportEndedAt): self
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

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(Organization $organization): self
    {
        // set the owning side of the relation if necessary
        if ($organization->getCorrespondent() !== $this) {
            $organization->setCorrespondent($this);
        }

        $this->organization = $organization;

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
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setPerson($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getPerson() === $this) {
                $formation->setPerson(null);
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

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setPerson($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getPerson() === $this) {
                $location->setPerson(null);
            }
        }

        return $this;
    }
}
