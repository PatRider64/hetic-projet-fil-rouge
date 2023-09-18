<?php

namespace App\Controller;

use App\Entity\Contest;
use App\Repository\ContestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
            ->setCity($request->request->get('city'))
            ->setInstrument($request->request->get('instrument'))
            ->setPrize($request->request->get('prize'))
            ->setDate(new \DateTime($request->request->get('date')))
            ->setDescription($request->request->get('description'))
            ->setSeasonality($request->request->get('seasonality'))
            ->setPhone($request->request->get('phone'))
            ->setAddress($request->request->get('address'))
            ->setJudges([])
            ->setWinners([]);
        ;

        $entityManager->persist($contest);
        $entityManager->flush();

        return $this->json([
            'message' => 'La creation du concours a ete realise avec succes'
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
    public function update(EntityManagerInterface $entityManager, Request $request, Contest $contest): Response
    {
        $contest->setName($request->request->get('name'))
            ->setCountry($request->request->get('country'))
            ->setCity($request->request->get('city'))
            ->setInstrument($request->request->get('instrument'))
            ->setPrize($request->request->get('prize'))
            ->setDate(new \DateTime($request->request->get('date')))
            ->setDescription($request->request->get('description'))
            ->setSeasonality($request->request->get('seasonality'))
            ->setPhone($request->request->get('phone'))
            ->setAddress($request->request->get('address'))
        ;

        $entityManager->flush();

        return $this->json(['message' => 'La modification du concours a ete realise avec succes']);
    }

    #[Route('/{id}', name: 'app_constest_delete', methods: ['POST'])]
    public function delete(Request $request, Contest $contest, ContestRepository $contestRepository): Response
    {
        $contestRepository->remove($contest, true);

        return $this->json([
            'message' => 'Concours supprime.'
        ]);
    }

    #[Route('/{id}/judges', name: 'app_contest_judges_api', methods: ['POST'])]
    public function judges(EntityManagerInterface $entityManager, Request $request, Contest $contest): Response
    {
        $judge = [];
        $name = $request->request->get('name');
        $status = $request->request->get('status');
        $instrument = $request->request->get('instrument');
        $nationality = $request->request->get('nationality');

        array_push($judge, $name, $status, $instrument, $nationality);
        $judges = $contest->getJudges();
        array_push($judges, $judge);
        $contest->setJudges($judges);
        $entityManager->flush();

        return $this->json([
            'message' => 'Juge ajoute.'
        ]);
    }

    #[Route('/{id}/winners', name: 'app_contest_winners_api', methods: ['POST'])]
    public function winners(EntityManagerInterface $entityManager, Request $request, Contest $contest): Response
    {
        $winner = [];
        $name = $request->request->get('name');
        $prize = $request->request->get('prize');
        $instrument = $request->request->get('instrument');
        $nationality = $request->request->get('nationality');
        $school = $request->request->get('school');

        array_push($winner, $name, $prize, $instrument, $nationality, $school);
        $winners = $contest->getWinners();
        array_push($winners, $winner);
        $contest->setWinners($winners);
        $entityManager->flush();

        return $this->json([
            'message' => 'Gagnant ajoute.'
        ]);
    }
}
