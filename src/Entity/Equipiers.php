<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\EquipiersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipiersRepository::class)]
#[ApiResource]
class Equipiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jours_travail = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Reservation::class, inversedBy: 'Equipiers')]
    private Collection $Reservation;

    #[ORM\ManyToMany(targetEntity: Etablissement::class, inversedBy: 'equipiers')]
    private Collection $Etablissement;

    public function __construct()
    {
        $this->Reservation = new ArrayCollection();
        $this->Etablissement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getJoursTravail(): ?\DateTimeInterface
    {
        return $this->jours_travail;
    }

    public function setJoursTravail(\DateTimeInterface $jours_travail): static
    {
        $this->jours_travail = $jours_travail;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservation(): Collection
    {
        return $this->Reservation;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->Reservation->contains($reservation)) {
            $this->Reservation->add($reservation);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        $this->Reservation->removeElement($reservation);

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissement(): Collection
    {
        return $this->Etablissement;
    }

    public function addEtablissement(Etablissement $etablissement): static
    {
        if (!$this->Etablissement->contains($etablissement)) {
            $this->Etablissement->add($etablissement);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): static
    {
        $this->Etablissement->removeElement($etablissement);

        return $this;
    }
}
