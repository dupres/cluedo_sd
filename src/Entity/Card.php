<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(length: 180, nullable: true)]
    private ?string $item_effect = null;

    #[ORM\Column(nullable: true)]
    private ?int $item_type_id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $subtitle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getItemEffect(): ?string
    {
        return $this->item_effect;
    }

    public function setItemEffect(?string $item_effect): static
    {
        $this->item_effect = $item_effect;

        return $this;
    }

    public function getItemTypeId(): ?int
    {
        return $this->item_type_id;
    }

    public function setItemTypeId(?int $item_type_id): static
    {
        $this->item_type_id = $item_type_id;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }
}
