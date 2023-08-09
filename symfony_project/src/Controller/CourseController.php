<?php

namespace App\Controller;

use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use App\Security\LoginFormAuthenticator;

#[Route('/course')]
class CourseController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_course_index')]
    public function index(CourseRepository $courseRepository): Response
    {
        return $this->json([
            'courses' => $courseRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_course_create_api', methods: ['POST'])]
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        $course = new Course;
        $course->setTitle($request->request->get('title'))
            ->setTeacher($this->security->getUser())
            ->setContent($request->request->get('content'));

        $entityManager->persist($course);
        $entityManager->flush();

        return $this->json([
            'message' => 'Votre nouveau cours est créé'
        ]);
    }

    #[Route('/{id}', name: 'app_course_show')]
    public function show(Course $course)
    {
        return $this->json([
            'course' => $course
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}/edit', name: 'app_course_update_api', methods: ['POST'])]
    public function update(Request $request, Course $course): Response
    {
        $course->setTitle($request->request->get('title'))
            ->setContent($request->request->get('content'));

        $entityManager->flush();

        return $this->json(['message' => 'La modification de votre cours a été réalisé avec succés']);
    }
}
