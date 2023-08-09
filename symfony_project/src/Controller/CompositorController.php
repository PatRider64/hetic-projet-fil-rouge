<?php

namespace App\Controller;

use App\Entity\Compositor;
use App\Repository\CompositorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('compositor')]
class CompositorController extends AbstractController
{
    #[Route('/', name: 'app_compositor_index')]
    public function index(CompositorRepository $compositorRepository): Response
    {
        return $this->json([
            'users' => $compositorRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_user_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response 
    {
        $compositor = new Compositor();

        $compositor->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setBirthDate($request->request->get('birthDate'))
            ->setDeathDate($request->request->get('deathDate'))
            ->setBiography($request->request->get('biography'));

        $entityManager->persist($compositor);
        $entityManager->flush();

        return $this->json([
            'message' => 'La création du profil du compositeur a été réalisé avec succés'
        ]);
    }

    #[Route('/{id}', name: 'app_compositor_show')]
    public function show(Compositor $compositor): Response
    {
        return $this->json([
            'compositor' => $compositor
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/{id}/edit', name: 'app_compositor_update_api', methods: ['POST'])]
    public function update(Request $request, Compositor $compositor, CompositorRepository $compositorRepository): Response
    {
        $compositor->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setBirthDate($request->request->get('birthDate'))
            ->setDeathDate($request->request->get('deathDate'))
            ->setBiography($request->request->get('biography'));

        $entityManager->flush();

        return $this->json(['message' => 'La modification du profil du compositeur a été réalisé avec succés']);
    }

    #[Route('/{id}', name: 'app_compositor_delete', methods: ['POST'])]
    public function delete(Request $request, Compositor $compositor, CompositorRepository $compositorRepository): Response
    {
        if (!$compositor) {
            return $this->redirectToRoute('app_error');
        }

        if (strval($this->getUser()->getId()) !== $id && !$this->security->isGranted('ROLE_ADMIN')) {
            return $this->redirect($request->headers->get('referer'));
        }

        if ($this->isCsrfTokenValid('delete' . $compositor->getId(), $request->request->get('_token'))) {
            $compositorRepository->remove($compositor, true);
        }

        return $this->redirectToRoute('app_compositor_index', [], Response::HTTP_SEE_OTHER);
    }
}
