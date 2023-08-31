<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/quiz')]
class QuizController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_quiz_index')]
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->json([
            'quizzes' => $quizRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_quiz_index_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $quiz = new Quiz();
        $entityManager->persist($quiz);
        $entityManager->flush();

        return $this->json(['message' => 'La création du quiz a été réalisée avec succés']);
    }

    #[Route('/{id}', name: 'app_quiz_show')]
    public function show(Quiz $quiz) : Reponse
    {
        return $this->json([
            'quiz' => $quiz
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}/edit', name: 'app_quiz_show')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Quiz $quiz) : Reponse
    {
        $quiz->setTitle($request->request->get('title'))
            ->setDescription($request->request->get('description'));

        $entityManager->flush();
    
        return $this->json([
            'message' => 'La modification du quiz a été réalisée avec succés'
        ]);
    }

    #[Route('/{id}/result', name: 'app_quiz_result', methods: ['POST'])]
    public function result(Quiz $quiz) {
        $user = $this->security->getUser();
        $score = 0;
        $questions = $quiz->getQuestions();
        $i = 1;

        foreach ($questions as $question) {
            $choice = $request->request->get('options_'.$i);

            if ($question->getAnswer() == $choice) {
                $score++;
            }
            $i++;
        }
        
        array_push($user->getQuizzesCompleted(), [$quiz->getTitle(), $score]);
        $entityManager->flush();

        return $this->json([
            'message' => 'Votre score est de '.$score.' points.'
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_delete', methods: ['POST'])]
    public function delete(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $quiz->getId(), $request->request->get('_token'))) {
            $quizRepository->remove($quiz, true);
        }

        return $this->json([
            'message' => 'La suppression du quiz a été réalisée avec succés.'
        ]);
    }
}
