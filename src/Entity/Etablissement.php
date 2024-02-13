<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/prestataires/{id}/etablissements',
            uriVariables: [
                'id' => new Link (fromClass: Prestataire::class, fromProperty: 'id', toProperty: 'prestataire')
            ]
        )
    ]
)]



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
    private ?\DateTimeInterface $heure_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_close = null;

    #[ORM\Column(length: 255)]
    private ?string $prixH = null;

    #[ORM\ManyToMany(targetEntity: Equipiers::class, mappedBy: 'Etablissement')]
    private Collection $Equipiers;

    #[ORM\ManyToMany(targetEntity: Services::class, inversedBy: 'Etablissements')]
    private Collection $Services;

    #[ORM\ManyToOne(inversedBy: 'Etablissements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prestataire $prestataire = null;



    public function __construct()
    {
        $this->Equipiers = new ArrayCollection();
        $this->Services = new ArrayCollection();
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

    public function getHeureOpen(): ?\DateTimeInterface
    {
        return $this->heure_open;
    }

    public function setHeureOpen(\DateTimeInterface $heure_open): static
    {
        $this->heure_open = $heure_open;

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

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): static
    {
        $this->prestataire = $prestataire;

        return $this;
    }
}
