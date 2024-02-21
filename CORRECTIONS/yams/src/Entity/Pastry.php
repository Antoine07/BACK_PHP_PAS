<?php

namespace App\Entity;

use App\Repository\PastryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PastryRepository::class)]
class Pastry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?array $origin = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $calory = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $quantity = null;

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

    public function getOrigin(): ?array
    {
        return $this->origin;
    }

    public function setOrigin(?array $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getCalory(): ?int
    {
        return $this->calory;
    }

    public function setCalory(?int $calory): static
    {
        $this->calory = $calory;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
