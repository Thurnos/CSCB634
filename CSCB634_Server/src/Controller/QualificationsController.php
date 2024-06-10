<?php

namespace App\Controller;

use App\Entity\Qualifications;
use App\Repository\QualificationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QualificationsController extends AbstractController
{
    private $entityManager;
    private $qualificationsRepository;

    public function __construct(EntityManagerInterface $entityManager, QualificationsRepository $qualificationsRepository)
    {
        $this->entityManager = $entityManager;
        $this->qualificationsRepository = $qualificationsRepository;
    }

    #[Route('qualifications/add', name: 'qualifications_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $qualification = new Qualifications();
        $qualification->setName($data['name'] ?? null);

        $this->entityManager->persist($qualification);
        $this->entityManager->flush();

        return $this->json(['message' => 'Qualification created successfully'], Response::HTTP_CREATED);
    }

    #[Route('qualifications/list', name: 'qualifications_list')]
    public function list(): Response
    {
        $qualifications = $this->qualificationsRepository->findAll();
        return $this->json($qualifications);
    }

    #[Route('qualifications/edit/{id}', name: 'qualifications_edit')]
    public function edit(Request $request, int $id): Response
    {
        $qualification = $this->qualificationsRepository->find($id);

        if (!$qualification) {
            return $this->json(['message' => 'Qualification not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $qualification->setName($data['name'] ?? $qualification->getName());

        $this->entityManager->flush();

        return $this->json(['message' => 'Qualification updated successfully']);
    }

    #[Route('/qualifications/delete/{id}', name: 'qualifications_delete')]
    public function delete(Request $request, int $id): Response
    {
        $qualification = $this->qualificationsRepository->find($id);
        
        if (!$qualification) {
            return $this->json(['message' => 'Qualification not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($qualification);
        $this->entityManager->flush();

        return $this->json(['message' => 'Qualification deleted successfully']);
    }
}