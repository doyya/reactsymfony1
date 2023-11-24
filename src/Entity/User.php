<?php

namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: UserRepository::class)]

class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
      #[Groups(["user"])]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Groups(["user"])]
    private ?string $nom = null;

    #[ORM\Column(length: 40)]
    #[Groups(["user"])]
    private ?string $prenom = null;

    #[ORM\Column(length: 40)]
    #[Groups(["user"])]
    private ?string $email = null;

    #[ORM\Column(length: 40)]
    #[Groups(["user"])]
    private ?string $adresse = null;

    #[ORM\Column(length: 40)]
    #[Groups(["user"])]
    private ?string $tel = null;
   

    #[ORM\ManyToMany(targetEntity: Possession::class, inversedBy: 'users', cascade:["persist", "remove"])]
    #[JoinTable(name: 'user_possession')]
   #[JoinColumn(name:"user_id", referencedColumnName: 'id')]
   #[InverseJoinColumn(name:"possession_id", referencedColumnName: 'id')]
   #[MaxDepth(1)] 
    private Collection $possessions;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(["user"])]
    private ?\DateTimeInterface $birthDate = null;

    public function __construct()
    {
        $this->possessions = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Possession>
     */
    public function getPossessions(): Collection
    {
        return $this->possessions;
    }

    public function addPossession(Possession $possession): static
    {
        if (!$this->possessions->contains($possession)) {
            $this->possessions->add($possession);
        }

        return $this;
    }

    public function removePossession(Possession $possession): static
    {
        $this->possessions->removeElement($possession);

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

     private int $age;
 
    /**
     * @param \DateTimeInterface $birthDate
     * @return int
     * 
     */
    #[Groups(["user"])]
    public function getAge(): int
    {
 
        //Calcule de l'age d'user
        $datetime1 = new \datetime('now'); // date actuelle
        $datetime2 = $this->getBirthDate();
        $age = $datetime1->diff($datetime2, true)->y; // le y = nombre d'années 
        
        
        return $age;
    }
 
}
