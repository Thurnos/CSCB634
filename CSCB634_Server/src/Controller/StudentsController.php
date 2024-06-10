<?php

namespace App\Controller;

use App\Entity\Students;
use App\Repository\StudentsRepository;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentsController extends AbstractController
{
    private $entityManager;
    private $studentsRepository;
    private $scheduleRepository;

    public function __construct(EntityManagerInterface $entityManager, StudentsRepository $studentsRepository, ScheduleRepository $scheduleRepository)
    {
        $this->entityManager = $entityManager;
        $this->studentsRepository = $studentsRepository;
        $this->scheduleRepository = $scheduleRepository;
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
        $student->setSchoolId($data['school_id'] ?? null);

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
        $student->setSchoolId($data['school_id'] ?? $student->setSchoolId());

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
        $students = $this->studentsRepository->findAll();
        return $this->json($students);
    }

    #[Route('/students/getSchedule/{id}', name: 'students_getSchedule')]
    public function getSchedule(int $id): Response
    {
        if (!$id) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $schedule = $this->scheduleRepository->findByStudentId($id);
        return $this->json($schedule);
    }
}
