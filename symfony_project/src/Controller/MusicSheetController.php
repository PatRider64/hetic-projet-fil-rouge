<?php

namespace App\Controller;

use App\Entity\MusicSheet;
use App\Repository\MusicSheetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UploadHelper;

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

    #[Route('/create', name:'app_music_sheet_create', methods:['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, UploadHelper $helper): Response
    {
        $file = $request->request->get('music_sheet');
        $musicSheetName = $helper->uploadMusicSheet($file);
        $originalMusicSheetName = $file->getClientOriginalName();

        $musicSheet = new MusicSheet();
        $musicSheet->setCompositor($request->request->get('compositor'))
            ->setFileName($musicSheetName)
            ->setOriginalFileName($originalMusicSheetName)
            ->setMimeType($file->getMimeType());

        $entityManager->persist($musicSheet);
        $entityManager->flush();
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
