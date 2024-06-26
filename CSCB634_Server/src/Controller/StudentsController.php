<?php

namespace App\Controller;

use App\Entity\Students;
use App\Repository\ParentsRepository;
use App\Repository\SchoolsRepository;
use App\Repository\StudentsRepository;
use App\Repository\ScheduleRepository;
use App\Repository\SubjectsRepository;
use App\Repository\TeachersRepository;
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
    private $parentsRepository;
    private $schoolsRepository;
    private $subjectsRepository;
    private $teachersRepository;

    public function __construct(EntityManagerInterface $entityManager, StudentsRepository $studentsRepository, ScheduleRepository $scheduleRepository,ParentsRepository $parentsRepository,SchoolsRepository $schoolsRepository,SubjectsRepository $subjectsRepository,TeachersRepository $teachersRepository)
    {
        $this->entityManager = $entityManager;
        $this->studentsRepository = $studentsRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->parentsRepository = $parentsRepository;
        $this->schoolsRepository = $schoolsRepository;
        $this->subjectsRepository = $subjectsRepository;
        $this->teachersRepository = $teachersRepository;
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

        return $this->json([
            'message' => 'Student created successfully',
            'id' => $student->getId(),
            'name' => $student->getName()
        ], Response::HTTP_CREATED);
    }

    #[Route('/students/getStudent/{id}', name: 'students_getStudent')]
    public function getStudent(int $id): Response
    {
        $student = $this->studentsRepository->find($id);
        if (!$student) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $school = $this->schoolsRepository->find($student->getSchoolId());
        $parentIds = $student->getParentIds();
        $parents = [];

        foreach ($parentIds as $parentId) {
            $parent = $this->parentsRepository->find($parentId);
            if ($parent) {
                $parents[] = [
                    'id' => $parent->getId(),
                    'name' => $parent->getName(),
                    'email' => $parent->getEmail(),
                    'number' => $parent->getNumber(),
                ];
            }
        }

        $result = [
            'id' => $student->getId(),
            'name' => $student->getName(),
            'school' => [
                'id' => $school ? $school->getId() : null,
                'name' => $school ? $school->getName() : '',
            ],
            'number' => $student->getNumber(),
            'email' => $student->getEmail(),
            'parents' => $parents,
        ];

        return $this->json($result);
    }

    #[Route('/students/getStudentByEmail/{email}', name: 'students_getStudent_email')]
    public function getStudentByEmail(string $email): Response
    {
        $student = $this->studentsRepository->findByEmail($email);
        $school = $this->schoolsRepository->find($student->getSchoolId());

        if (!$student) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $result[] = [
            'id' => $student->getId(),
            'name' => $student->getName(),
            'school' => [
                'id' => $school->getId(),
                'name' => $school ? $school->getName() : ''
            ],
            'number' => $student->getNumber(),
            'email' => $student->getEmail(),
            'parentIds' => $student->getParentIds()
        ];

        return $this->json($result);
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
        $result = [];

        foreach ($students as $student) {
            $school = $this->schoolsRepository->find($student->getSchoolId());

            $result[] = [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'school' => [
                    'id' => $school->getId(),
                    'name' => $school ? $school->getName() : ''
                ],
                'number' => $student->getNumber(),
                'email' => $student->getEmail(),
                'parentIds' => $student->getParentIds()
            ];
        }
        return $this->json($result);
    }

    #[Route('/students/listBySchool/{id}', name: 'students_listBySchool')]
    public function listBySchool(int $id): Response
    {
        $students = $this->studentsRepository->findBySchoolId($id);
        $result = [];

        foreach ($students as $student) {
            $school = $this->schoolsRepository->find($student->getSchoolId());

            $result[] = [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'school' => [
                    'id' => $school->getId(),
                    'name' => $school ? $school->getName() : ''
                ],
                'number' => $student->getNumber(),
                'email' => $student->getEmail(),
                'parentIds' => $student->getParentIds()
            ];
        }
        return $this->json($result);
    }


    #[Route('/students/getSchedule/{id}', name: 'students_getSchedule')]
    public function getSchedule(int $id): Response
    {
        $student = $this->studentsRepository->find($id);

        if (!$id) {
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $schedule = $this->scheduleRepository->findByStudentId($id);
        $teacher = $this->teachersRepository->find($schedule->getTeacherId());
        $mondaySubjects = $this->fetchSubjects($schedule->getMonday());
        $tuesdaySubjects = $this->fetchSubjects($schedule->getTuesday());
        $wednesdaySubjects = $this->fetchSubjects($schedule->getWednesday());
        $thursdaySubjects = $this->fetchSubjects($schedule->getThursday());
        $fridaySubjects = $this->fetchSubjects($schedule->getFriday());

        $result[] = [
            'student_id' => $student->getId(),
            'name' => $student->getName(),
            'schedule' =>[
                'id' => $schedule->getId(),
                'teacher' => [
                    'id' => $teacher->getId(),
                    'name' => $teacher->getName()
                ],
                'monday' => $mondaySubjects,
                'tuesday' => $tuesdaySubjects,
                'wednesday' => $wednesdaySubjects,
                'thursday' => $thursdaySubjects,
                'friday' => $fridaySubjects,
            ]
        ];
        return $this->json($result);
    }

    private function fetchSubjects(array $subjectIds): array
    {
        $subjects = [];
        foreach ($subjectIds as $subjectId) {
            $subject = $this->subjectsRepository->find($subjectId);
            if ($subject)
                $subjects[] = [
                    'id' => $subject->getId(),
                    'name' => $subject->getName(),
                ];

        }
        return $subjects;
    }
}
