<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Message;
use App\Repository\ChatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('chat')]
class ChatController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    #[Route('/', name: 'app_chat')]
    public function index(ChatRepository $chatRepository): Response
    {
        return $this->json([
            'chats' => $chatRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_chat_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response 
    {
        //Création du chat
        $userSite = $this->security->getUser();
        $chat = new Chat();

        $chat->setTopic($request->request->get('topic'));
        $entityManager->persist($chat);

        //Création du premier message
        $message = new Message();
        $message->setUserSite($userSite);
        $message->setDate(new \DateTime('now', new \DateTimeZone('Europe/Paris')));
        $message->setContent($request->request->get('message'));
        $entityManager->persist($message);

        $chat->addMessage($message);
        $entityManager->flush();

        return $this->json([
            'message' => 'La création du topic à été réalisée avec succés.'
        ]);
    }

    #[Route('/{id}', name: 'app_chat_show')]
    public function show(Chat $chat): Response
    {
        return $this->json([
            'chat' => $chat
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}', name: 'app_chat_delete', methods: ['POST'])]
    public function delete(Request $request, Chat $chat, ChatRepository $chatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $chat->getId(), $request->request->get('_token'))) {
            $chatRepository->remove($chat, true);
        }

        return $this->json([
            'message' => 'Topic supprimé.'
        ]);
    }
}
