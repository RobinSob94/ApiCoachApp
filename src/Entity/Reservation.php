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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_reservation = null;

    #[ORM\Column]
    private ?float $note = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $heure_reservation = null;

    #[ORM\ManyToMany(targetEntity: Equipiers::class, mappedBy: 'Reservation')]
    private Collection $Equipiers;

    #[ORM\ManyToMany(targetEntity: Reservations::class, mappedBy: 'Reservations')]
    private Collection $Services;

    #[ORM\ManyToMany(targetEntity: Services::class, mappedBy: 'Services')]
    private Collection $Reservations;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Reservation')]
    private Collection $Users;

    public function __construct()
    {
        $this->Equipiers = new ArrayCollection();
        $this->Services = new ArrayCollection();
        $this->Reservations = new ArrayCollection();
        $this->Users = new ArrayCollection();
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

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): static
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

    public function getHeureReservation(): ?\DateTimeInterface
    {
        return $this->heure_reservation;
    }

    public function setHeureReservation(\DateTimeInterface $heure_reservation): static
    {
        $this->heure_reservation = $heure_reservation;

        return $this;
    }

    /**
     * @return Collection<int, Equipiers>
     */
    public function getEquipiers(): Collection
    {
        return $this->Equipiers;
    }

    public function addEquipier(Equipiers $equipier): static
    {
        if (!$this->Equipiers->contains($equipier)) {
            $this->Equipiers->add($equipier);
            $equipier->addReservation($this);
        }

        return $this;
    }

    public function removeEquipier(Equipiers $equipier): static
    {
        if ($this->Equipiers->removeElement($equipier)) {
            $equipier->removeReservation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getServices(): Collection
    {
        return $this->Services;
    }

    public function addService(self $service): static
    {
        if (!$this->Services->contains($service)) {
            $this->Services->add($service);
        }

        return $this;
    }

    public function removeService(self $service): static
    {
        $this->Services->removeElement($service);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getReservations(): Collection
    {
        return $this->Reservations;
    }

    public function addReservation(self $reservation): static
    {
        if (!$this->Reservations->contains($reservation)) {
            $this->Reservations->add($reservation);
            $reservation->addService($this);
        }

        return $this;
    }

    public function removeReservation(self $reservation): static
    {
        if ($this->Reservations->removeElement($reservation)) {
            $reservation->removeService($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->Users;
    }

    public function addUser(User $user): static
    {
        if (!$this->Users->contains($user)) {
            $this->Users->add($user);
            $user->addReservation($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->Users->removeElement($user)) {
            $user->removeReservation($this);
        }

        return $this;
    }
}
