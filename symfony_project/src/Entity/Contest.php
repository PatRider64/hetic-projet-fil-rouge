<?php

namespace App\Entity;

use App\Repository\ContestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContestRepository::class)]
class Contest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups('main')]
    private ?string $name = null;

    #[ORM\Column(length: 25)]
    #[Groups('main')]
    private ?string $country = null;

    #[ORM\Column(length: 25)]
    #[Groups('main')]
    private ?string $city = null;

    #[ORM\Column(length: 25)]
    #[Groups('main')]
    private ?string $instrument = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Groups('main')]
    private ?string $prize = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups('main')]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $seasonality = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 200)]
    private ?string $address = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $winners = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $juries = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getInstrument(): ?string
    {
        return $this->instrument;
    }

    public function setInstrument(string $instrument): static
    {
        $this->instrument = $instrument;

        return $this;
    }

    public function getPrize(): ?string
    {
        return $this->prize;
    }

    public function setPrize(?string $prize): static
    {
        $this->prize = $prize;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getSeasonality(): ?string
    {
        return $this->seasonality;
    }

    public function setSeasonality(?string $seasonality): static
    {
        $this->seasonality = $seasonality;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getWinners(): ?array
    {
        return $this->winners;
    }

    public function setWinners(?array $winners): static
    {
        $this->winners = $winners;

        return $this;
    }

    public function getJuries(): ?array
    {
        return $this->juries;
    }

    public function setJuries(?array $juries): static
    {
        $this->juries = $juries;

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
}
