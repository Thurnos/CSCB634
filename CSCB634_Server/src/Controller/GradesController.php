<?php

// src/Controller/GradesController.php

namespace App\Controller;

use App\Entity\Grades;
use App\Repository\GradesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GradesController extends AbstractController
{
    private $entityManager;
    private $gradesRepository;

    public function __construct(EntityManagerInterface $entityManager, GradesRepository $gradesRepository)
    {
        $this->entityManager = $entityManager;
        $this->gradesRepository = $gradesRepository;
    }

    #[Route('/grades/add', name: 'grades_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $grade = new Grades();
        $grade->setGrade($data['grade'] ?? null);
        $grade->setStudentId($data['student_id']);
        $grade->setSchoolId($data['school_id']);

        $this->entityManager->persist($grade);
        $this->entityManager->flush();

        return $this->json(['message' => 'Grade created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/grades/getGrade/{id}', name: 'grades_getGrade')]
    public function getGrade(int $id): Response
    {
        $grade = $this->gradesRepository->find($id);

        if (!$grade) {
            return $this->json(['message' => 'Grade not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($grade);
    }

    #[Route('/grades/edit/{id}', name: 'grades_edit')]
    public function edit(Request $request, int $id): Response
    {
        $grade = $this->gradesRepository->find($id);

        if (!$grade) {
            return $this->json(['message' => 'Grade not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $grade->setGrade($data['grade'] ?? $grade->getGrade());
        $grade->setStudentId($data['student_id'] ?? $grade->getStudentId());
        $grade->setSchoolId($data['school_id'] ?? $grade->getSchoolId());

        $this->entityManager->flush();

        return $this->json(['message' => 'Grade updated successfully']);
    }

    #[Route('/grades/delete/{id}', name: 'grades_delete')]
    public function delete(int $id): Response
    {
        $grade = $this->gradesRepository->find($id);

        if (!$grade) {
            return $this->json(['message' => 'Grade not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($grade);
        $this->entityManager->flush();

        return $this->json(['message' => 'Grade deleted successfully']);
    }

    #[Route('/grades/list', name: 'grades_list')]
    public function list(): Response
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $grades = $this->gradesRepository->findAll();

        return $this->json($serializer->serialize($grades, 'json'));
    }
}

