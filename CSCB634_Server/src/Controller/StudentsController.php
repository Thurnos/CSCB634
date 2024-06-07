<?php

namespace App\Controller;

use App\Entity\Students;
use App\Repository\StudentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class StudentsController extends AbstractController
{
    private $entityManager;
    private $studentsRepository;

    public function __construct(EntityManagerInterface $entityManager, StudentsRepository $studentsRepository)
    {
        $this->entityManager = $entityManager;
        $this->studentsRepository = $studentsRepository;
    }

    #[Route('/students/add', name: 'students_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $student = new Students();
        $student->setName($data['name'] ?? null);
        $student->setEmail($data['email'] ?? null);
        $student->setNumber($data['number'] ?? null);
        $student->setParentIds($data['parent_ids'] ?? []);

        $this->entityManager->persist($student);
        $this->entityManager->flush();

        return $this->json(['message' => 'Student created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/students/getStudent/{id}', name: 'students_getStudent')]
    public function getStudent(int $id): Response
    {
        $student = $this->studentsRepository->find($id);

        if (!$student) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($student);
    }

    #[Route('/students/edit/{id}', name: 'students_get')]
    public function edit(Request $request, int $id): Response
    {
        $student = $this->studentsRepository->find($id);

        if (!$student) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $student->setName($data['name'] ?? $student->getName());
        $student->setEmail($data['email'] ?? $student->getEmail());
        $student->setNumber($data['number'] ?? $student->getNumber());
        $student->setParentIds($data['parent_ids'] ?? $student->getParentIds());

        $this->entityManager->flush();
        return $this->json(['message' => 'Student updated successfully']);
    }

    #[Route('/students/delete/{id}', name: 'students_delete')]
    public function delete(int $id): Response
    {
        $student = $this->studentsRepository->find($id);

        if (!$student) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($student);
        $this->entityManager->flush();

        return $this->json(['message' => 'Student deleted successfully']);
    }

    #[Route('/students/list', name: 'students_list')]
    public function list(): Response
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $students = $this->studentsRepository->findAll();

        return $this->json($serializer->serialize($students, 'json'));
    }

    //TODO getParent
}
