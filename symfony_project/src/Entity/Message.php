<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('main')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[Groups('main')]
    private ?UserSite $userSite = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups('main')]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups('main')]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?Chat $chat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserSite(): ?UserSite
    {
        return $this->userSite;
    }

    public function setUserSite(?UserSite $userSite): static
    {
        $this->userSite = $userSite;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }
}
