<?php

namespace App\Controller;

use App\Entity\UserSite;
use App\Entity\Subscription;
use App\Entity\Invoice;
use App\Repository\UserSiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Request;

#[Route('/user_site')]
class UserSiteController extends AbstractController
{
    #[Route('/', name: 'app_user_site_index')]
    public function index(UserSiteRepository $userSiteRepository): Response
    {
        return $this->json([
            'users' => $userSiteRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_user_site_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, UserAuthenticatorInterface $authenticator, 
    LoginFormAuthenticator $formAuthenticator, UserPasswordHasherInterface $hasher): Response 
    {
        $user = new UserSite();

        $user->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setEmail($request->request->get('email'))
            ->setPassword($hasher->hashPassword($user, $request->request->get('password')))
            ->setRoles([$request->request->get('type')])
            ->setFreeTrialUsed(false);

        if ($request->request->get('type') == 'ROLE_STUDENT') {
            $user->setCoursesTaken(0)
                ->setQuizzesCompleted([])
                ->setVideoCount(0);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return $authenticator->authenticateUser(
            $user,
            $formAuthenticator,
            $request
        );

        return $this->json([
            'message' => 'L’inscription est reussie'
        ]);
    }

    #[Route('/{id}', name: 'app_user_site_show')]
    public function show(UserSite $user): Response
    {
        return $this->json([
            'user' => $user
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}/edit', name: 'app_user_site_update_api', methods: ['POST'])]
    public function update(Request $request, UserSite $user, EntityManagerInterface $entityManager,
    UserPasswordHasherInterface $hasher): Response
    {
        $user->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setEmail($request->request->get('email'))
            ->setPassword($hasher->hashPassword($user, $request->request->get('password')));

        $entityManager->flush();

        return $this->json(['message' => 'La modification de votre compte a ete realise avec succes']);
    }

    #[Route('/{id}', name: 'app_user_site_delete', methods: ['POST'])]
    public function delete(Request $request, UserSite $user, UserSiteRepository $userSiteRepository): Response
    {
        $userSiteRepository->remove($user, true);

        return $this->json(['message' => 'La suppression de votre compte a ete realise avec succes']);
    }

    #[Route('{id}/subscription', name: 'app_user_site_subscription', methods: ['POST'])]
    public function subscription(Request $request, UserSite $user, EntityManagerInterface $entityManager)
    {
        if ($this->isGranted('ROLE_SUBSCRIBER')) {
            return $this->json(['message' => 'Vous vous etes deja abonne']);
        } else {
            $dateStart = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
            $typeSubscription = $request->request->get('subscription');

            switch($typeSubscription) {
                case 'freeTrial':
                    if ($user->isFreeTrialUsed()) {
                        return $this->json(['message' => 'L\'essai gratuit n\'est plus disponible']);
                    } else {
                        $dateEnd = $dateStart->modify('+1 month');
                        $type = 'Free trial';
                        $amount = 0;
                        $user->setFreeTrialUsed(true);
                        break;
                    }
                case 'monthly':
                    $dateEnd = $dateStart->modify('+1 month');
                    $type = 'Monthly';
                    $amount = 20;
                    break;
                case 'yearly':
                    $dateEnd = $dateStart->modify('+1 year');
                    $type = 'Yearly';
                    $amount = 190;
            }

            $user->setExpirationDate($dateEnd);
            $user->setRoles(['ROLE_SUBSCRIBER']);

            $subscription = new Subscription();
            $subscription->setUserSite($user)
                ->setDateStart($dateStart)
                ->setDateEnd($dateEnd)
                ->setType($type);
            ;
            $entityManager->persist($subscription);

            $invoice = new Invoice();
            $invoice->setDateInvoice($dateStart)
                ->setAmount($amount)
            ;
            $entityManager->persist($invoice);
            $subscription->setInvoice($invoice);
            $entityManager->flush();

            return $this->json(['message' => 'Vous etes maintenant abonne']);
        }
    }
}
