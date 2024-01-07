<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
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
    private ?\DateTimeInterface $heureÃ_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_close = null;

    #[ORM\Column(length: 255)]
    private ?string $prixH = null;

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

    public function getHeureÃOpen(): ?\DateTimeInterface
    {
        return $this->heureÃ_open;
    }

    public function setHeureÃOpen(\DateTimeInterface $heureÃ_open): static
    {
        $this->heureÃ_open = $heureÃ_open;

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
}
