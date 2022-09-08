<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address implements \Stringable
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
    private $street;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Beneficiary::class, mappedBy="address")
     */
    private $beneficiaries;

    public function __construct()
    {
        $this->beneficiaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function __toString(): string
    {
        return $this->street.' '.$this->zip.' '.$this->city.' '.$this->country;
    }

    /**
     * @return Collection<int, Beneficiary>
     */
    public function getBeneficiaries(): Collection
    {
        return $this->beneficiaries;
    }

    public function addBeneficiary(Beneficiary $beneficiary): self
    {
        if (!$this->beneficiaries->contains($beneficiary)) {
            $this->beneficiaries[] = $beneficiary;
            $beneficiary->setAddress($this);
        }

        return $this;
    }

    public function removeBeneficiary(Beneficiary $beneficiary): self
    {
        if ($this->beneficiaries->removeElement($beneficiary)) {
            // set the owning side to null (unless already changed)
            if ($beneficiary->getAddress() === $this) {
                $beneficiary->setAddress(null);
            }
        }

        return $this;
    }
}
