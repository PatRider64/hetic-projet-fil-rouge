<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/create', name: 'app_quiz_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $quiz = new Quiz();

        $quiz->setTitle($request->request->get('title'))
            ->setDescription($request->request->get('description'));
        
        $entityManager->persist($quiz);
        $entityManager->flush();

        return $this->json(['message' => 'La creation du quiz a ete realisee avec succes']);
    }

    #[Route('/{id}', name: 'app_quiz_show')]
    public function show(Quiz $quiz) : Response
    {
        return $this->json([
            'quiz' => $quiz
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}/edit', name: 'app_quiz_update_api')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Quiz $quiz) : Response
    {
        $quiz->setTitle($request->request->get('title'))
            ->setDescription($request->request->get('description'));

        $entityManager->flush();
    
        return $this->json([
            'message' => 'La modification du quiz a ete realisee avec succes'
        ]);
    }

    #[Route('/{id}/result', name: 'app_quiz_result', methods: ['POST'])]
    public function result(Quiz $quiz, Request $request, EntityManagerInterface $entityManager) : Response
    {
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
        
        $quizzes = $user->getQuizzesCompleted();
        array_push($quizzes, [$quiz->getTitle(), $score.'/'.$i-1]);
        $user->setQuizzesCompleted($quizzes);
        $entityManager->flush();

        return $this->json([
            'message' => 'Votre score est de '.$score.' points.'
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_delete', methods: ['POST'])]
    public function delete(Request $request, Quiz $quiz, QuizRepository $quizRepository): Response
    {
        $quizRepository->remove($quiz, true);

        return $this->json([
            'message' => 'La suppression du quiz a ete réalisee avec succes.'
        ]);
    }
}
