<?php

namespace App\Entity;

use App\Repository\MusicSheetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Service\UploadHelper;

#[ORM\Entity(repositoryClass: MusicSheetRepository::class)]
class MusicSheet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('main')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'musicSheets')]
    private ?Compositor $compositor = null;

    #[ORM\OneToMany(mappedBy: 'musicSheet', targetEntity: Masterclass::class)]
    private Collection $masterclass;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('main')]
    private ?string $originalFileName = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $mimeType = null;

    public function __construct()
    {
        $this->masterclass = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompositor(): ?Compositor
    {
        return $this->compositor;
    }

    public function setCompositor(?Compositor $compositor): static
    {
        $this->compositor = $compositor;

        return $this;
    }

    /**
     * @return Collection<int, Masterclass>
     */
    public function getMasterclass(): Collection
    {
        return $this->masterclass;
    }

    public function addMasterclass(Masterclass $masterclass): static
    {
        if (!$this->masterclass->contains($masterclass)) {
            $this->masterclass->add($masterclass);
            $masterclass->setMusicSheet($this);
        }

        return $this;
    }

    public function removeMasterclass(Masterclass $masterclass): static
    {
        if ($this->masterclass->removeElement($masterclass)) {
            // set the owning side to null (unless already changed)
            if ($masterclass->getMusicSheet() === $this) {
                $masterclass->setMusicSheet(null);
            }
        }

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getOriginalFileName(): ?string
    {
        return $this->originalFileName;
    }

    public function setOriginalFileName(?string $originalFileName): static
    {
        $this->originalFileName = $originalFileName;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): static
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getFilePath(): string
    {
        return '/' . UploadHelper::MUSIC_SHEET_PATH . '/' . $this->getFilename();
    }
}
