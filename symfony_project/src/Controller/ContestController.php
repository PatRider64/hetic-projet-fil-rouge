<?php

namespace App\Controller;

use App\Entity\Contest;
use App\Repository\ContestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('contest')]
class ContestController extends AbstractController
{
    #[Route('/', name: 'app_contest')]
    public function index(ContestRepository $contestRepository): Response
    {
        return $this->json([
            'contests' => $contestRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_contest_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response 
    {
        $contest = new Contest();

        $contest->setName($request->request->get('name'))
            ->setCountry($request->request->get('country'))
            ->City($request->request->get('birthDate'))
            ->setInstrument($request->request->get('intrument'))
            ->setPrice($request->request->get('price'))
            ->setDate($request->request->get('date'))
            ->setDescription($request->request->get('description'))
            ->setSeasonality($request->request->get('seasonality'))
            ->setPhone($request->request->get('phone'))
            ->setAddress($request->request->get('address'))
        ;

        $entityManager->persist($contest);
        $entityManager->flush();

        return $this->json([
            'message' => 'La création du concours a été réalisé avec succés'
        ]);
    }

    #[Route('/{id}', name: 'app_contest_show')]
    public function show(Contest $contest): Response
    {
        return $this->json([
            'contest' => $contest
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}/edit', name: 'app_contest_update_api', methods: ['POST'])]
    public function update(Request $request, Compositor $compositor, CompositorRepository $compositorRepository): Response
    {
        $compositor->setName($request->request->get('name'))
            ->setCountry($request->request->get('country'))
            ->City($request->request->get('birthDate'))
            ->setInstrument($request->request->get('intrument'))
            ->setPrice($request->request->get('price'))
            ->setDate($request->request->get('date'))
            ->setDescription($request->request->get('description'))
            ->setSeasonality($request->request->get('seasonality'))
            ->setPhone($request->request->get('phone'))
            ->setAddress($request->request->get('address'))
        ;

        $entityManager->flush();

        return $this->json(['message' => 'La modification du concours a été réalisé avec succés']);
    }

    #[Route('/{id}', name: 'app_constest_delete', methods: ['POST'])]
    public function delete(Request $request, Contest $contest, ContestRepository $contestRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contest->getId(), $request->request->get('_token'))) {
            $contestRepository->remove($contest, true);
        }

        return $this->json([
            'message' => 'Concours supprimé.'
        ]);
    }

    #[Route('/{id}/judges', name: 'app_contest_judges_api', methods: ['POST'])]
    public function judges(Request $request, Contest $contest, ContestRepository $contestRepository): Response
    {
        $judge = [];
        $name = $request->request->get('name');
        $status = $request->request->get('status');
        $instrument = $request->request->get('instrument');
        $nationality = $request->request->get('nationality');

        array_push($judge, $name, $status, $instrument, $nationality);
        array_push($contest->getJuries(), $judge);
        $entityManager->flush();

        return $this->json([
            'message' => 'Juge ajouté.'
        ]);
    }

    #[Route('/{id}/winners', name: 'app_contest_winners_api', methods: ['POST'])]
    public function winners(Request $request, Contest $contest, ContestRepository $contestRepository): Response
    {
        $winner = [];
        $name = $request->request->get('name');
        $prize = $request->request->get('prize');
        $instrument = $request->request->get('instrument');
        $nationality = $request->request->get('nationality');
        $school = $request->request->get('school');

        array_push($winner, $name, $prize, $instrument, $nationality, $school);
        array_push($contest->getWinners(), $winner);
        $entityManager->flush();

        return $this->json([
            'message' => 'Gagnant ajouté.'
        ]);
    }
}
