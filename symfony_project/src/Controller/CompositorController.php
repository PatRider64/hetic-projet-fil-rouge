<?php

namespace App\Controller;

use App\Entity\Compositor;
use App\Repository\CompositorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/compositor')]
class CompositorController extends AbstractController
{
    #[Route('/', name: 'app_compositor_index')]
    public function index(CompositorRepository $compositorRepository): Response
    {
        return $this->json([
            'users' => $compositorRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }

    #[Route('/create', name: 'app_compositor_create_api', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response 
    {
        $compositor = new Compositor();

        $compositor->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setBirthDate(new \DateTime($request->request->get('birthDate')))
            ->setDeathDate(new \DateTime($request->request->get('deathDate')))
            ->setBiography($request->request->get('biography'));

        $entityManager->persist($compositor);
        $entityManager->flush();

        return $this->json([
            'message' => 'La creation du profil du compositeur a ete realise avec succes'
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
    public function update(EntityManagerInterface $entityManager, Request $request, Compositor $compositor, 
    CompositorRepository $compositorRepository): Response
    {
        $compositor->setName($request->request->get('name'))
            ->setFirstName($request->request->get('firstName'))
            ->setBirthDate(new \DateTime($request->request->get('birthDate')))
            ->setDeathDate(new \DateTime($request->request->get('deathDate')))
            ->setBiography($request->request->get('biography'));

        $entityManager->flush();

        return $this->json(['message' => 'La modification du profil du compositeur a ete realise avec succes']);
    }

    #[Route('/{id}', name: 'app_compositor_delete', methods: ['POST'])]
    public function delete(Request $request, Compositor $compositor, CompositorRepository $compositorRepository): Response
    {
        $compositorRepository->remove($compositor, true);

        return $this->json(['message' => 'La suppression du profil du compositeur a ete realise avec succes']);
    }
}
