<?php

namespace App\Controller;

use App\Entity\Masterclass;
use App\Entity\MasterclassVideo;
use App\Repository\MasterclassRepository;
use App\Repository\UserSiteRepository;
use App\Repository\MusicSheetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UploadHelper;
use Symfony\Component\HttpFoundation\Request;

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
    public function create(Request $request, EntityManagerInterface $entityManager, UserSiteRepository $userRepository,
    MusicSheetRepository $musicSheetRepository, UploadHelper $helper): Response 
    {
        $masterclass = new Masterclass();
        $studentId = $request->request->get('student');
        $musicSheetId = $request->request->get('musicSheet');
        $student = $userRepository->findBy(['id' => $studentId])[0];
        $musicSheet = $musicSheetRepository->findBy(['id' => $musicSheetId])[0];

        $fileVideo = $request->files->get('video');
        $videoName = $helper->uploadMasterclassVideo($fileVideo);
        $originalVideoName = $fileVideo->getClientOriginalName();

        $masterclassVideo = new MasterclassVideo();
        $masterclassVideo->setFileName($videoName)
            ->setOriginalFileName($originalVideoName)
            ->setMimeType($fileVideo->getMimeType());
        $entityManager->persist($masterclassVideo);

        $masterclass->setAnalysis($request->request->get('analysis'))
            ->setInstruments($request->request->get('instruments'))
            ->setStudent($student)
            ->setMusicSheet($musicSheet)
            ->setMasterclassVideo($masterclassVideo);

        $entityManager->persist($masterclass);
        $entityManager->flush();

        return $this->json([
            'message' => 'Le masterclass a ete cree'
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
    public function update(EntityManagerInterface $entityManager, Request $request, Masterclass $masterclass,
    UserSiteRepository $userRepository, MusicSheetRepository $musicSheetRepository): Response
    {
        $studentId = $request->request->get('student');
        $musicSheetId = $request->request->get('musicSheet');
        $student = $userRepository->findBy(['id' => $studentId])[0];
        $musicSheet = $musicSheetRepository->findBy(['id' => $musicSheetId])[0];
        
        $masterclass->setAnalysis($request->request->get('analysis'))
            ->setInstruments($request->request->get('instruments'))
            ->setStudent($student)
            ->setMusicSheet($musicSheet);

        $entityManager->flush();

        return $this->json(['message' => 'La modification du masterclass a ete realise avec succes']);
    }
}
