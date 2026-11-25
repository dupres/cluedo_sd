<?php

namespace App\Entity;

use App\Repository\CollectsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectsRepository::class)]
class Collects
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $participation_id = null;

    #[ORM\Column]
    private ?int $card_id = null;

    #[ORM\Column]
    private ?int $acquisition_round = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParticipationId(): ?int
    {
        return $this->participation_id;
    }

    public function setParticipationId(int $participation_id): static
    {
        $this->participation_id = $participation_id;

        return $this;
    }

    public function getCardId(): ?int
    {
        return $this->card_id;
    }

    public function setCardId(int $card_id): static
    {
        $this->card_id = $card_id;

        return $this;
    }

    public function getAcquisitionRound(): ?int
    {
        return $this->acquisition_round;
    }

    public function setAcquisitionRound(int $acquisition_round): static
    {
        $this->acquisition_round = $acquisition_round;

        return $this;
    }
}
