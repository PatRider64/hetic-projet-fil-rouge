<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {
        $date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $userSite = $this->security->getUser();

        if($userSite) {
            if ($userSite->getDateExpiration()->format('Y-m-d') == $date->format('Y-m-d') && 
            in_array('SUBSCRIBER', $userSite->getRoles())) {
                array_diff($userSite->getRoles(), ['SUBSCRIBER']);
            }
        }

        return $this->json(['message' => 'Bienvenue']);
    }
}
