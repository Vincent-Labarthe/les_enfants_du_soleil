<?php

namespace App\Entity;

use App\Repository\GeneralIdentifierRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: GeneralIdentifierRepository::class)]
#[UniqueEntity('email')]
class GeneralIdentifier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: Beneficiary::class, inversedBy: 'generalIdentifier', cascade: ['persist', 'remove'])]
    private $beneficiary;

    #[ORM\OneToOne(targetEntity: Employee::class, inversedBy: 'generalIdentifier', cascade: ['persist', 'remove'])]
    private $employee;

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

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
