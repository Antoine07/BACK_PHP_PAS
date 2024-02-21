<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column]
    private ?float $score = null;

    #[ORM\ManyToMany(targetEntity: Pastry::class, inversedBy: 'users')]
    private Collection $user_pastries;


    public function __construct()
    {
        $this->user_pastries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(float $score): static
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection<int, Pastry>
     */
    public function getUserPastries(): Collection
    {
        return $this->user_pastries;
    }

    public function addUserPastry(Pastry $userPastry): static
    {
        if (!$this->user_pastries->contains($userPastry)) {
            $this->user_pastries->add($userPastry);
        }

        return $this;
    }

    public function removeUserPastry(Pastry $userPastry): static
    {
        $this->user_pastries->removeElement($userPastry);

        return $this;
    }

  
}
