<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Link;
use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new GetCollection(
            uriTemplate: '/prestataires/{id}/etablissements',
            uriVariables: [
                'id' => new Link (fromProperty: 'id', toProperty: 'prestataire', fromClass: Prestataire::class)
            ]
            ),
        new Post(),
        new Delete(),
        new Patch(), 
        new Put()
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



    #[ORM\ManyToOne(inversedBy: 'Etablissements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prestataire $prestataire = null;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Equipiers::class)]
    private Collection $equipiers;

    #[ORM\ManyToMany(targetEntity: Services::class, inversedBy: 'etablissements')]
    private Collection $services;



    public function __construct()
    {
        $this->equipiers = new ArrayCollection();
        $this->services = new ArrayCollection();
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

  

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): static
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    /**
     * @return Collection<int, Equipiers>
     */
    public function getEquipiers(): Collection
    {
        return $this->equipiers;
    }

    public function addEquipier(Equipiers $equipier): static
    {
        if (!$this->equipiers->contains($equipier)) {
            $this->equipiers->add($equipier);
            $equipier->setEtablissement($this);
        }

        return $this;
    }

    public function removeEquipier(Equipiers $equipier): static
    {
        if ($this->equipiers->removeElement($equipier)) {
            // set the owning side to null (unless already changed)
            if ($equipier->getEtablissement() === $this) {
                $equipier->setEtablissement(null);
            }
        }

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
}
