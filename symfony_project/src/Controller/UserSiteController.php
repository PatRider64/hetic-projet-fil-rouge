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
use App\Security\LoginFormAuthenticator;

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

    #[Route('/create', name: 'app_user_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, UserAuthenticatorInterface $authenticator, 
    LoginFormAuthenticator $formAuthenticator): Response 
    {
        $user = new UserSite();

        $user->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setEmail($request->request->get('email'))
            ->setPassword($this->passwordHasher->hashPassword($user, $form->getData()->getPassword()))
            ->setRoles([$request->request->get('type')]);

        if ($request->request->get('type') == 'STUDENT') {
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
            'message' => 'L’inscription est réussie'
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
    public function update(Request $request, UserSite $user): Response
    {
        $user->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setEmail($request->request->get('email'))
            ->setPassword($this->passwordHasher->hashPassword($user, $form->getData()->getPassword()));

        $entityManager->flush();

        return $this->json(['message' => 'La modification de votre compte a été réalisé avec succés']);
    }

    #[Route('/{id}', name: 'app_user_site_delete', methods: ['POST'])]
    public function delete(Request $request, UserSite $user, UserSiteRepository $userSiteRepository): Response
    {
        if (!$user) {
            return $this->redirectToRoute('app_error');
        }

        if (strval($this->getUser()->getId()) !== $id && !$this->security->isGranted('ROLE_ADMIN')) {
            return $this->redirect($request->headers->get('referer'));
        }

        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userSiteRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_site_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('{id}/subscription', name: 'app_user_site_subscription', methods: ['POST'])]
    public function subscription(Request $request, UserSite $user)
    {
        if ($this->isGranted('SUBSCRIBER')) {
            return $this->json(['message' => 'Vous vous êtes déjà abonné']);
        } else {
            $dateStart = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
            $typeSubscription = $request->request->get('subscription');

            switch($typeSubscription) {
                case 'freeTrial':
                    if ($this->isGranted('FIRST_TRIAL')) {
                        return $this->json(['message' => 'L\'essai gratuit n\'est plus disponible']);
                    } else {
                        $dateEnd = $dateStart->modify('+1 month');
                        $type = 'Free trial';
                        $amount = 0;
                        array_push($user->getRoles(), 'FIRST_TRIAL');
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

            $user->setDateExpiration($dateEnd);
            array_push($user->getRoles(), 'SUBSCRIBER');

            $subscription = new Subscription;
            $subscription->setUserSite($user)
                ->setDateStart($dateStart)
                ->setDateEnd($dateEnd)
                ->setType($type);
            ;
            $entityManager->persist($subscription);

            $invoice = new Invoice;
            $invoice->setDateInvoice($dateStart)
                ->setAmount($amount)
            ;
            $entityManager->persist($invoice);
            $subscription->setInvoice($invoice);
            $entityManager->flush();

            return $this->json(['message' => 'Vous êtes maintenant abonné']);
        }
    }
}
