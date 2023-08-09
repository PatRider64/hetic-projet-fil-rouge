<?php

namespace App\Controller;

use App\Entity\Masterclass;
use App\Repository\MasterclassRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/masterclass')]
class MasterclassController extends AbstractController
{
    #[Route('/', name: 'app_masterclass_index')]
    public function index(MasterclassRepository $masterclassRepository): Response
    {
        return $this->json([
            'masterclasses' => $masterclassRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_masterclass_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response 
    {
        $masterclass = new Masterclass();

        $user->setAnalysis($request->request->get('analysis'))
            ->setInstruments($request->request->get('instruments'))
            ->setStudent($request->request->get('student'))
            ->setMusicSheet([$request->request->get('musicSheet')]);

        $entityManager->persist($masterclass);
        $entityManager->flush();

        return $this->json([
            'message' => 'Le masterclass a été créé'
        ]);
    }

    #[Route('/{id}', name: 'app_masterclass_show')]
    public function show(Masterclass $masterclass)
    {
        return $this->json([
            'masterclass' => $masterclass
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}/edit', name: 'app_masterclass_update_api', methods: ['POST'])]
    public function update(Request $request, Masterclass $masterclass): Response
    {
        $user->setAnalysis($request->request->get('analysis'))
            ->setInstruments($request->request->get('instruments'))
            ->setStudent($request->request->get('student'))
            ->setMusicSheet([$request->request->get('musicSheet')]);

        $entityManager->flush();

        return $this->json(['message' => 'La modification du masterclass a été réalisé avec succés']);
    }
}
