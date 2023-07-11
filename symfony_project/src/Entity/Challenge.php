<?php

namespace App\Entity;

use App\Repository\ChallengeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: userSite::class, inversedBy: 'challenges')]
    private Collection $userSite;

    public function __construct()
    {
        $this->userSite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, userSite>
     */
    public function getUserSite(): Collection
    {
        return $this->userSite;
    }

    public function addUserSite(userSite $userSite): static
    {
        if (!$this->userSite->contains($userSite)) {
            $this->userSite->add($userSite);
        }

        return $this;
    }

    public function removeUserSite(userSite $userSite): static
    {
        $this->userSite->removeElement($userSite);

        return $this;
    }
}
