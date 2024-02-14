<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ApiResource]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_reservation = null;

    #[ORM\Column]
    private ?float $note = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $heure_reservation = null;







    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Equipiers $equipiers = null;

    #[ORM\ManyToMany(targetEntity: Services::class, inversedBy: 'reservations')]
    private Collection $services;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Equipiers::class)]
    private Collection $equipier;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $users = null;



    public function __construct()
    {
        $this->Equipiers = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->equipier = new ArrayCollection();
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

    public function getDateReservation(): ?\DateTimeImmutable
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeImmutable $date_reservation): static
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getHeureReservation(): ?\DateTimeImmutable
    {
        return $this->heure_reservation;
    }

    public function setHeureReservation(\DateTimeImmutable $heure_reservation): static
    {
        $this->heure_reservation = $heure_reservation;

        return $this;
    }


   

    public function getEquipiers(): ?Equipiers
    {
        return $this->equipiers;
    }

    public function setEquipiers(?Equipiers $equipiers): static
    {
        $this->equipiers = $equipiers;

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }

        return $this;
    }

    public function removeService(Services $service): static
    {
        $this->services->removeElement($service);

        return $this;
    }

    /**
     * @return Collection<int, Equipiers>
     */
    public function getEquipier(): Collection
    {
        return $this->equipier;
    }

    public function addEquipier(Equipiers $equipier): static
    {
        if (!$this->equipier->contains($equipier)) {
            $this->equipier->add($equipier);
            $equipier->setReservation($this);
        }

        return $this;
    }

    public function removeEquipier(Equipiers $equipier): static
    {
        if ($this->equipier->removeElement($equipier)) {
            // set the owning side to null (unless already changed)
            if ($equipier->getReservation() === $this) {
                $equipier->setReservation(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }


}
