<?php

namespace App\Controller;

use App\Entity\Schools;
use App\Repository\SchoolsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchoolsController extends AbstractController
{
    private $entityManager;
    private $schoolsRepository;

    public function __construct(EntityManagerInterface $entityManager, SchoolsRepository $schoolsRepository)
    {
        $this->entityManager = $entityManager;
        $this->schoolsRepository = $schoolsRepository;
    }

    #[Route('/schools/add', name: 'schools_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $school = new Schools();
        $school->setName($data['name'] ?? null);
        $school->setAddress($data['address'] ?? null);

        $this->entityManager->persist($school);
        $this->entityManager->flush();

        return $this->json(['message' => 'School created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/schools/getSchool/{id}', name: 'schools_getSchool')]
    public function getSchool(int $id): Response
    {
        $school = $this->schoolsRepository->find($id);

        if (!$school) {
            return $this->json(['message' => 'School not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($school);
    }

    #[Route('/schools/edit/{id}', name: 'schools_edit')]
    public function edit(Request $request, int $id): Response
    {
        $school = $this->schoolsRepository->find($id);

        if (!$school) {
            return $this->json(['message' => 'School not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $school->setName($data['name'] ?? $school->getName());
        $school->setAddress($data['address'] ?? $school->getAddress());

        $this->entityManager->flush();

        return $this->json(['message' => 'School updated successfully']);
    }

    #[Route('/schools/delete/{id}', name: 'schools_delete')]
    public function delete(int $id): Response
    {
        $school = $this->schoolsRepository->find($id);

        if (!$school) {
            return $this->json(['message' => 'School not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($school);
        $this->entityManager->flush();

        return $this->json(['message' => 'School deleted successfully']);
    }

    #[Route('/schools/list', name: 'schools_list')]
    public function list(): Response
    {
        $schools = $this->schoolsRepository->findAll();
        return $this->json($schools);
    }
}
