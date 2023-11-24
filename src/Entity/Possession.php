<?php

namespace App\Entity;


use App\Repository\PossessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: PossessionRepository::class)]

class Possession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
 #[Groups(["possession"])]
    #[ORM\Column(length: 40)]
     #[Groups(["possession"])]
    private ?string $nom = null;

    #[ORM\Column]
     #[Groups(["possession"])]
    private ?float $valeur = null;

    #[ORM\Column(length: 40)]
     #[Groups(["possession"])]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'possessions')]
   #[JoinTable(name: 'user_possession')]
   #[JoinColumn(name:"possession_id", referencedColumnName: 'id')]
   #[InverseJoinColumn(name:"user_id", referencedColumnName: 'id')]
  
   #[MaxDepth(1)]
   
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): static
    {
        $this->valeur = $valeur;

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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addPossession($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removePossession($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom." " .$this->valeur." " .$this->type;
    }

}
