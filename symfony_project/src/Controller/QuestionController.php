<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuizRepository;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/question', name: 'app_question_index')]
    public function index(QuestionRepository $questionRepository): Response
    {
        return $this->json([
            'questions' => $questionRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{quizId}/createQuestion', name: 'app_question_create_api', methods: ['POST'])]
    public function createQuestion(Request $request, EntityManagerInterface $entityManager, 
    QuizRepository $quizRepository, $quizId) : Response
    {
        $quiz = $quizRepository->findBy(['id' => $quizId]);
        $question = new Question();
        $question->setOption1($request->request->get('option1'))
            ->setOption2($request->request->get('option2'))
            ->setOption3($request->request->get('option3'))
            ->setOption4($request->request->get('option4'));
            
        $answer = $request->request->get('answer');

        switch($answer) {
            case 1:
                $question->setAnswer($request->request->get('option1'));
                break;
            case 2:
                $question->setAnswer($request->request->get('option2'));
                break;
            case 3:
                $question->setAnswer($request->request->get('option3'));
                break;
            case 4:
                $question->setAnswer($request->request->get('option4'));
                break;
        }

        $entityManager->persist($question);
        $quiz->addQuestion($question);
        $entityManager->flush();
        
        return $this->json([
            'message' => 'Question ajoutée'
        ]);
    }
}
