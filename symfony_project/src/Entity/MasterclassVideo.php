<?php

namespace App\Entity;

use App\Repository\MasterclassVideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Service\UploadHelper;

#[ORM\Entity(repositoryClass: MasterclassVideoRepository::class)]
class MasterclassVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('main')]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'masterclassVideo', cascade: ['persist', 'remove'])]
    private ?Masterclass $masterclass = null;

    #[ORM\Column(length: 100)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255)]
    #[Groups('main')]
    private ?string $originalFileName = null;

    #[ORM\Column(length: 50)]
    private ?string $mimeType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMasterclass(): ?Masterclass
    {
        return $this->masterclass;
    }

    public function setMasterclass(?Masterclass $masterclass): static
    {
        $this->masterclass = $masterclass;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getOriginalFileName(): ?string
    {
        return $this->originalFileName;
    }

    public function setOriginalFileName(string $originalFileName): static
    {
        $this->originalFileName = $originalFileName;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): static
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getFilePath(): string
    {
        return UploadHelper::MASTERCLASS_VIDEO_PATH . '/' . $this->getFilename();
    }
}
