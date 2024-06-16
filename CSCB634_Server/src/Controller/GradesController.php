<?php

// src/Controller/GradesController.php

namespace App\Controller;

use App\Entity\Grades;
use App\Repository\GradesRepository;
use App\Repository\StudentsRepository;
use App\Repository\SchoolsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradesController extends AbstractController
{
    private $entityManager;
    private $gradesRepository;
    private $studentsRepository;
    private $schoolsRepository;

    public function __construct(EntityManagerInterface $entityManager, GradesRepository $gradesRepository, StudentsRepository $studentsRepository, 
    SchoolsRepository $schoolsRepository)
    {
        $this->entityManager = $entityManager;
        $this->gradesRepository = $gradesRepository;
        $this->studentsRepository = $studentsRepository;
        $this->schoolsRepository = $schoolsRepository;
    }

    #[Route('/grades/add', name: 'grades_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $grade = new Grades();
        $grade->setGrade($data['grade'] ?? null);
        $grade->setStudentIds($data['student_ids'] ?? []);
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
        $grade->setStudentIds($data['student_ids'] ?? $grade->getStudentIds());
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
        $grades = $this->gradesRepository->findAll();
        $result = [];

        foreach ($grades as $grade) {
            $school = $this->schoolsRepository->find($grade->getSchoolId());
            $gradeId = $grade->getId();

            $result[] = [
                'id' => $gradeId,
                'grade' => $grade->getGrade(),
                'school' => [
                    'id' => $grade->getSchoolId(),
                    'name' => $school ? $school->getName() : ''
                ],
                'students' => json_decode($this->getStudents($gradeId)->getContent(), true),
            ];
        }
        return $this->json($result);
    }

    #[Route('/grades/getStudents/{id}', name: 'grades_students')]
    public function getStudents(int $id): Response
    {
        $grade = $this->gradesRepository->find($id);

        if (!$grade) {
            return $this->json(['message' => 'Grade not found'], Response::HTTP_NOT_FOUND);
        }

        $studentIds = $this->gradesRepository->find($grade->getId())->getStudentIds();

        foreach ($studentIds as $studentId) {
            $student = $this->studentsRepository->find($studentId);

            if($student) {        
                $results[] = [
                    'id' => $studentId,
                    'name' => $student->getName(),
                    'email' => $student->getEmail(),
                    'number' => $student->getNumber(),
                ];
            }
        }
        return $this->json($results);
    }

    #[Route('/grades/getGradeByStudent/{id}', name: 'grade_student')]
    public function getStudentGrade(int $id): Response
    {
        $student = $this->studentsRepository->find($id);

        if (!$student)
            return $this->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);

        $grades = $this->gradesRepository->findByStudentId($id);

        if (!$grades)
            return $this->json(['message' => 'Grades not found'], Response::HTTP_NOT_FOUND);

        $result = [];
        foreach ($grades as $grade) {
            $school = $this->schoolsRepository->find($grade->getSchoolId());
            $gradeId = $grade->getId();

            $result[] = [
                'id' => $gradeId,
                'grade' => $grade->getGrade(),
                'school' => [
                    'id' => $grade->getSchoolId(),
                    'name' => $school ? $school->getName() : ''
                ],
                'students' => json_decode($this->getStudents($gradeId)->getContent(), true),
            ];
        }
        return $this->json($result);
    }

}

