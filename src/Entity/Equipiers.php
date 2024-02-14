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



    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;



    #[ORM\ManyToMany(targetEntity: Etablissement::class, inversedBy: 'equipiers')]
    private Collection $Etablissement;

    #[ORM\Column(type: Types::ARRAY)]
    private array $jours_travail = [];

    #[ORM\OneToMany(mappedBy: 'equipiers', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\ManyToOne(inversedBy: 'equipier')]
    private ?Reservation $reservation = null;



    public function __construct()
    {
        $this->Etablissement = new ArrayCollection();
        $this->reservations = new ArrayCollection();
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

    public function getJoursTravail(): array
    {
        return $this->jours_travail;
    }

    public function setJoursTravail(array $jours_travail): static
    {
        $this->jours_travail = $jours_travail;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setEquipiers($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEquipiers() === $this) {
                $reservation->setEquipiers(null);
            }
        }

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }

}
