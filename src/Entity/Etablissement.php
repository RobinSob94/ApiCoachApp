<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
#[ApiResource]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_etablissement = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure�_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_close = null;

    #[ORM\Column(length: 255)]
    private ?string $prixH = null;

    #[ORM\ManyToMany(targetEntity: Equipiers::class, mappedBy: 'Etablissement')]
    private Collection $Equipiers;

    #[ORM\ManyToMany(targetEntity: Services::class, inversedBy: 'Etablissements')]
    private Collection $Services;

    #[ORM\ManyToMany(targetEntity: Prestataire::class, inversedBy: 'Etablissements')]
    private Collection $Prestataire;

    public function __construct()
    {
        $this->Equipiers = new ArrayCollection();
        $this->Services = new ArrayCollection();
        $this->Prestataire = new ArrayCollection();
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

    public function getNomEtablissement(): ?string
    {
        return $this->nom_etablissement;
    }

    public function setNomEtablissement(string $nom_etablissement): static
    {
        $this->nom_etablissement = $nom_etablissement;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getHeure�Open(): ?\DateTimeInterface
    {
        return $this->heure�_open;
    }

    public function setHeure�Open(\DateTimeInterface $heure�_open): static
    {
        $this->heure�_open = $heure�_open;

        return $this;
    }

    public function getHeureClose(): ?\DateTimeInterface
    {
        return $this->heure_close;
    }

    public function setHeureClose(\DateTimeInterface $heure_close): static
    {
        $this->heure_close = $heure_close;

        return $this;
    }

    public function getPrixH(): ?string
    {
        return $this->prixH;
    }

    public function setPrixH(string $prixH): static
    {
        $this->prixH = $prixH;

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
            $equipier->addEtablissement($this);
        }

        return $this;
    }

    public function removeEquipier(Equipiers $equipier): static
    {
        if ($this->Equipiers->removeElement($equipier)) {
            $equipier->removeEtablissement($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getServices(): Collection
    {
        return $this->Services;
    }

    public function addService(Services $service): static
    {
        if (!$this->Services->contains($service)) {
            $this->Services->add($service);
        }

        return $this;
    }

    public function removeService(Services $service): static
    {
        $this->Services->removeElement($service);

        return $this;
    }

    /**
     * @return Collection<int, Prestataire>
     */
    public function getPrestataire(): Collection
    {
        return $this->Prestataire;
    }

    public function addPrestataire(Prestataire $prestataire): static
    {
        if (!$this->Prestataire->contains($prestataire)) {
            $this->Prestataire->add($prestataire);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): static
    {
        $this->Prestataire->removeElement($prestataire);

        return $this;
    }
}
