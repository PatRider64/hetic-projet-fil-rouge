<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_home_page')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $userSite = $this->security->getUser();

        if ($userSite && $userSite->getExpirationDate()) {
            if ($userSite->getExpirationDate()->format('Y-m-d') == $date->format('Y-m-d') && $this->isGranted('ROLE_SUBSCRIBER')) {
                $userSite->setRoles(['ROLE_STUDENT']);
                $entityManager->flush();
            }
        }

        return $this->json(['message' => 'Bienvenue']);
    }
}
