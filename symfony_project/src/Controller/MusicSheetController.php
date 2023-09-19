<?php

namespace App\Controller;

use App\Entity\MusicSheet;
use App\Repository\MusicSheetRepository;
use App\Repository\CompositorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UploadHelper;
use Symfony\Component\HttpFoundation\Request;

#[Route('/music_sheet')]
class MusicSheetController extends AbstractController
{
    #[Route('/', name: 'app_music_sheet_index')]
    public function index(MusicSheetRepository $musicSheetRepository): Response
    {
        return $this->json([
            'music_sheets' => $musicSheetRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name:'app_music_sheet_create_api', methods:['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, UploadHelper $helper,
    CompositorRepository $compositorRepository): Response
    {
        $file = $request->files->get('musicSheet');
        $musicSheetName = $helper->uploadMusicSheet($file);
        $originalMusicSheetName = $file->getClientOriginalName();
        $compositorId = $request->request->get('compositor');
        $compositor = $compositorRepository->findBy(['id' => $compositorId])[0];

        $musicSheet = new MusicSheet();
        $musicSheet->setCompositor($compositor)
            ->setFileName($musicSheetName)
            ->setOriginalFileName($originalMusicSheetName)
            ->setMimeType($file->getMimeType());

        $entityManager->persist($musicSheet);
        $entityManager->flush();

        return $this->json(['message' => 'Partition creee']);
    }

    #[Route('/{id}/download', name: 'app_music_sheet_download', methods: ['GET'])]
    public function musicSheetDownload(MusicSheet $musicSheet, UploadHelper $helper)
    {
        $response = new StreamedResponse();
        $response->setCallBack(function () use ($musicSheet, $helper) {
            $outputStream = fopen('php://output', 'wb');
            $fileStream = $helper->readStream($musicSheet->getFilePath());
            stream_copy_to_stream($fileStream, $outputStream);
        });

        $response->headers->set('Content-Type', $musicSheet->getMimeType());

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            $musicSheet->getOriginalFileName()
        );
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}
