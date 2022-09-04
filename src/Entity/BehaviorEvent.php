<?php

namespace App\Entity;

use App\Repository\BehaviorEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BehaviorEventRepository::class)
 */
class BehaviorEvent
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
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=Beneficiary::class, inversedBy="behaviorEvent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $beneficiary;

    /**
     * @ORM\ManyToOne(targetEntity=EventBehaviorType::class, inversedBy="behaviorEvent")
     * @ORM\JoinColumn(nullable=false)
     */
    private  $eventBehaviorType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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

    public function getEventBehaviorType(): ?EventBehaviorType
    {
        return $this->eventBehaviorType;
    }

    public function setEventBehaviorType(?EventBehaviorType $eventBehaviorType): self
    {
        $this->eventBehaviorType = $eventBehaviorType;

        return $this;
    }

}
