<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Repository\ChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

#[Route('message')]
class MessageController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_message')]
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->json([
            'messages' => $messageRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create/{chatId}', name: 'app_message_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, ChatRepository $chatRepository,
    $chatId): Response 
    {
        $userSite = $this->security->getUser();
        $chat = $chatRepository->findBy(['id' => $chatId])[0];

        //Création du message
        $message = new Message();
        $message->setUserSite($userSite);
        $message->setDate(new \DateTime('now', new \DateTimeZone('Europe/Paris')));
        $message->setContent($request->request->get('message'));
        $entityManager->persist($message);

        $chat->addMessage($message);
        $entityManager->flush();

        return $this->json([
            'message' => 'Ajout d\'un message.'
        ]);
    }

    #[Route('/{id}', name: 'app_message_show')]
    public function show(Message $message): Response
    {
        return $this->json([
            'message' => $message
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}', name: 'app_message_delete', methods: ['POST'])]
    public function delete(EntityManagerInterface $entityManager, Request $request, Message $message, 
    MessageRepository $messageRepository): Response
    {
        $messageRepository->remove($message, true);

        return $this->json([
            'message' => 'Message supprimé.'
        ]);
    }
}
