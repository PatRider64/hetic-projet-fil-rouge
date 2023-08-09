<?php

namespace App\Entity;

use App\Repository\CompositorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompositorRepository::class)]
class Compositor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('main')]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    #[Groups('main')]
    private ?string $name = null;

    #[ORM\Column(length: 32)]
    #[Groups('main')]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $deathDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $biography = null;

    #[ORM\OneToMany(mappedBy: 'compositor', targetEntity: MusicSheet::class)]
    private Collection $musicSheets;

    public function __construct()
    {
        $this->musicSheets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

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

    public function getDeathDate(): ?\DateTimeInterface
    {
        return $this->deathDate;
    }

    public function setDeathDate(\DateTimeInterface $deathDate): static
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection<int, MusicSheet>
     */
    public function getMusicSheets(): Collection
    {
        return $this->musicSheets;
    }

    public function addMusicSheet(MusicSheet $musicSheet): static
    {
        if (!$this->musicSheets->contains($musicSheet)) {
            $this->musicSheets->add($musicSheet);
            $musicSheet->setCompositor($this);
        }

        return $this;
    }

    public function removeMusicSheet(MusicSheet $musicSheet): static
    {
        if ($this->musicSheets->removeElement($musicSheet)) {
            // set the owning side to null (unless already changed)
            if ($musicSheet->getCompositor() === $this) {
                $musicSheet->setCompositor(null);
            }
        }

        return $this;
    }
}
