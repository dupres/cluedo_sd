<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $is_bot = null;

    #[ORM\Column]
    private ?int $play_order = null;

    #[ORM\Column]
    private ?bool $has_won = null;

    #[ORM\Column(nullable: true)]
    private ?int $eliminated_round = null;

    #[ORM\Column(nullable: true)]
    private ?int $cards_acquired = null;

    #[ORM\Column(nullable: true)]
    private ?int $hypotheses_count = null;

    #[ORM\Column(nullable: true)]
    private ?int $cards_shown = null;

    #[ORM\Column(nullable: true)]
    private ?int $cards_viewed = null;

    #[ORM\Column(nullable: true)]
    private ?int $distance_walked = null;

    #[ORM\Column(nullable: true)]
    private ?int $destinations_reached = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $game_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $character_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isBot(): ?bool
    {
        return $this->is_bot;
    }

    public function setIsBot(bool $is_bot): static
    {
        $this->is_bot = $is_bot;

        return $this;
    }

    public function getPlayOrder(): ?int
    {
        return $this->play_order;
    }

    public function setPlayOrder(int $play_order): static
    {
        $this->play_order = $play_order;

        return $this;
    }

    public function hasWon(): ?bool
    {
        return $this->has_won;
    }

    public function setHasWon(bool $has_won): static
    {
        $this->has_won = $has_won;

        return $this;
    }

    public function getEliminatedRound(): ?int
    {
        return $this->eliminated_round;
    }

    public function setEliminatedRound(?int $eliminated_round): static
    {
        $this->eliminated_round = $eliminated_round;

        return $this;
    }

    public function getCardsAcquired(): ?int
    {
        return $this->cards_acquired;
    }

    public function setCardsAcquired(?int $cards_acquired): static
    {
        $this->cards_acquired = $cards_acquired;

        return $this;
    }

    public function getHypothesesCount(): ?int
    {
        return $this->hypotheses_count;
    }

    public function setHypothesesCount(?int $hypotheses_count): static
    {
        $this->hypotheses_count = $hypotheses_count;

        return $this;
    }

    public function getCardsShown(): ?int
    {
        return $this->cards_shown;
    }

    public function setCardsShown(?int $cards_shown): static
    {
        $this->cards_shown = $cards_shown;

        return $this;
    }

    public function getCardsViewed(): ?int
    {
        return $this->cards_viewed;
    }

    public function setCardsViewed(?int $cards_viewed): static
    {
        $this->cards_viewed = $cards_viewed;

        return $this;
    }

    public function getDistanceWalked(): ?int
    {
        return $this->distance_walked;
    }

    public function setDistanceWalked(?int $distance_walked): static
    {
        $this->distance_walked = $distance_walked;

        return $this;
    }

    public function getDestinationsReached(): ?int
    {
        return $this->destinations_reached;
    }

    public function setDestinationsReached(?int $destinations_reached): static
    {
        $this->destinations_reached = $destinations_reached;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getGameId(): ?int
    {
        return $this->game_id;
    }

    public function setGameId(int $game_id): static
    {
        $this->game_id = $game_id;

        return $this;
    }

    public function getCharacterId(): ?int
    {
        return $this->character_id;
    }

    public function setCharacterId(?int $character_id): static
    {
        $this->character_id = $character_id;

        return $this;
    }
}
