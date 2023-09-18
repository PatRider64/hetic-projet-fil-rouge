<?php

namespace App\Entity;

use App\Repository\MasterclassRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MasterclassRepository::class)]
class Masterclass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('main')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups('main')]
    private ?string $analysis = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups('main')]
    private ?string $instruments = null;

    #[ORM\ManyToOne(inversedBy: 'masterclasses')]
    private ?UserSite $student = null;

    #[ORM\ManyToOne(inversedBy: 'masterclass')]
    private ?MusicSheet $musicSheet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnalysis(): ?string
    {
        return $this->analysis;
    }

    public function setAnalysis(?string $analysis): static
    {
        $this->analysis = $analysis;

        return $this;
    }

    public function getInstruments(): ?string
    {
        return $this->instruments;
    }

    public function setInstruments(?string $instruments): static
    {
        $this->instruments = $instruments;

        return $this;
    }

    public function getStudent(): ?UserSite
    {
        return $this->student;
    }

    public function setStudent(?UserSite $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getMusicSheet(): ?MusicSheet
    {
        return $this->musicSheet;
    }

    public function setMusicSheet(?MusicSheet $musicSheet): static
    {
        $this->musicSheet = $musicSheet;

        return $this;
    }
}
