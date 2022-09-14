<?php

namespace App\Entity;

use App\Repository\BeneficiaryEdsEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeneficiaryEdsEntityRepository::class)]
class BeneficiaryEdsEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'EdsEntity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Beneficiary $beneficiary = null;

    #[ORM\ManyToOne(inversedBy: 'beneficiary')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EdsEntity $edsEntity = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEdsEntity(): ?EdsEntity
    {
        return $this->edsEntity;
    }

    public function setEdsEntity(?EdsEntity $edsEntity): self
    {
        $this->edsEntity = $edsEntity;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }
}
