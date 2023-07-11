<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Quiz $quiz = null;

    #[ORM\Column(length: 150)]
    private ?string $question = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: QuestionOption::class)]
    private Collection $questionOptions;

    #[ORM\OneToOne(mappedBy: 'question', cascade: ['persist', 'remove'])]
    private ?QuestionAnswer $questionAnswer = null;

    public function __construct()
    {
        $this->questionOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection<int, QuestionOption>
     */
    public function getQuestionOptions(): Collection
    {
        return $this->questionOptions;
    }

    public function addQuestionOption(QuestionOption $questionOption): static
    {
        if (!$this->questionOptions->contains($questionOption)) {
            $this->questionOptions->add($questionOption);
            $questionOption->setQuestion($this);
        }

        return $this;
    }

    public function removeQuestionOption(QuestionOption $questionOption): static
    {
        if ($this->questionOptions->removeElement($questionOption)) {
            // set the owning side to null (unless already changed)
            if ($questionOption->getQuestion() === $this) {
                $questionOption->setQuestion(null);
            }
        }

        return $this;
    }

    public function getQuestionAnswer(): ?QuestionAnswer
    {
        return $this->questionAnswer;
    }

    public function setQuestionAnswer(?QuestionAnswer $questionAnswer): static
    {
        // unset the owning side of the relation if necessary
        if ($questionAnswer === null && $this->questionAnswer !== null) {
            $this->questionAnswer->setQuestion(null);
        }

        // set the owning side of the relation if necessary
        if ($questionAnswer !== null && $questionAnswer->getQuestion() !== $this) {
            $questionAnswer->setQuestion($this);
        }

        $this->questionAnswer = $questionAnswer;

        return $this;
    }
}
