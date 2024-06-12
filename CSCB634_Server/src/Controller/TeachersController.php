<?php

namespace App\Controller;

use App\Entity\Teachers;
use App\Repository\TeachersRepository;
use App\Repository\GradesRepository;
use App\Repository\AttendanceRepository;
use App\Repository\MarksRepository;
use App\Repository\StudentsRepository;
use App\Repository\SubjectsRepository;
use App\Repository\QualificationsRepository;
use App\Repository\ScheduleRepository;
use App\Repository\SchoolsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeachersController extends AbstractController
{
    private $entityManager;
    private $teachersRepository;
    private $gradesRepository;
    private $attendanceRepository;
    private $marksRepository;
    private $scheduleRepository;
    private $studentsRepository;
    private $qualificationsRepository;
    private $subjectsRepository;
    private $schoolsRepository;

    public function __construct(EntityManagerInterface $entityManager, TeachersRepository $teachersRepository, GradesRepository $gradesRepository,
    AttendanceRepository $attendanceRepository, MarksRepository $marksRepository, ScheduleRepository $scheduleRepository, 
    StudentsRepository $studentsRepository, QualificationsRepository $qualificationsRepository, SubjectsRepository $subjectsRepository, 
    SchoolsRepository $schoolsRepository)
    {
        $this->entityManager = $entityManager;
        $this->teachersRepository = $teachersRepository;
        $this->gradesRepository = $gradesRepository;
        $this->attendanceRepository = $attendanceRepository;
        $this->marksRepository = $marksRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->studentsRepository = $studentsRepository;
        $this->qualificationsRepository = $qualificationsRepository;
        $this->subjectsRepository = $subjectsRepository;
        $this->schoolsRepository = $schoolsRepository;
    }

    #[Route('/teachers/add', name: 'teachers_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $teacher = new Teachers();
        $teacher->setName($data['name'] ?? null);
        $teacher->setEmail($data['email'] ?? null);
        $teacher->setQualificationIds($data['qualification_ids'] ?? []);
        $teacher->setSchoolId($data['school_id'] ?? null);
        $teacher->setGradeIds($data['grade_ids'] ?? []);
        $teacher->setSubjectIds($data['subject_ids'] ?? []);

        $this->entityManager->persist($teacher);
        $this->entityManager->flush();

        return $this->json(['message' => 'Teacher created successfully'], Response::HTTP_CREATED);
     }

     #[Route('/teachers/getTeacher/{id}', name: 'teachers_getTeacher')]
    public function getTeacher(int $id): Response
    {
        $teacher = $this->teachersRepository->find($id);

        if (!$teacher) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($teacher);
    }

    #[Route('/teachers/edit/{id}', name: 'teachers_edit')]
    public function edit(Request $request, int $id): Response
    {
        $teacher = $this->teachersRepository->find($id);

        if (!$teacher) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $teacher->setName($data['name'] ?? $teacher->getName());
        $teacher->setEmail($data['email'] ?? $teacher->getEmail());
        $teacher->setQualificationIds($data['qualification_ids'] ?? $teacher->getQualificationIds());
        $teacher->setSchoolId($data['school_id'] ?? $teacher->getSchoolId());
        $teacher->setGradeIds($data['grade_ids'] ?? $teacher->getGradeIds());
        $teacher->setSubjectIds($data['subject_ids'] ?? $teacher->getSubjectIds());

        $this->entityManager->flush();

        return $this->json(['message' => 'Teacher updated successfully']);
    }


    #[Route('/teachers/delete/{id}', name: 'teachers_delete')]
    public function delete(int $id): Response
    {
        $teacher = $this->teachersRepository->find($id);

        if (!$teacher) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($teacher);
        $this->entityManager->flush();

        return $this->json(['message' => 'Teacher deleted successfully']);
    }

    #[Route('/teachers/list', name: 'teachers_list')]
    public function list(): Response
    {
        $teachers = $this->teachersRepository->findAll();
        $result = [];

        foreach ($teachers as $teacher) {
            $school = $this->schoolsRepository->find($teacher->getSchoolId());
            $teacherId = $teacher->getId();

            $result[] = [
                'id' => $teacherId,
                'name' => $teacher->getName(),
                'school' => [
                    'id' => $teacher->getSchoolId(),
                    'name' => $school ? $school->getName() : ''
                ],
                'subjects' => json_decode($this->getSubjects($teacherId)->getContent(), true),
                'grades' => json_decode($this->getGrades($teacherId)->getContent(), true),
                'qualifications' => json_decode($this->getQualifications($teacherId)->getContent(), true),

            ];
        }
        return $this->json($result);
    }

    #[Route('/teachers/getStudents/{id}', name: 'teachers_students')]
    public function getStudents(int $id): Response
    {
        $teacher = $this->teachersRepository->find($id);

        if (!$teacher) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        $gradeIds = $teacher->getGradeIds();

        if (!$gradeIds) {
            return $this->json(['message' => 'Grades not found'], Response::HTTP_NOT_FOUND);
        }

        $results = [];
       
        foreach ($gradeIds as $gradeId) {   
            $studentIds = $this->gradesRepository->find($gradeId)->getStudentIds();

            foreach ($studentIds as $studentId) {
                $student = $this->studentsRepository->find($studentId);

                if($student) {
                    // Fetch marks and attendance for the student
                    $marks = $this->marksRepository->findByStudentId($studentId);
                    $attendance = $this->attendanceRepository->findByStudentId($studentId);
        
                    // Append the grades and attendance to the student data
                    $results[] = [
                        'id' => $studentId,
                        'name' => $student->getName(),
                        'email' => $student->getEmail(),
                        'number' => $student->getNumber(),
                        'marks' => $marks,
                        'attendance' => $attendance,
                    ];
                }
            }
        }

        return $this->json($results);
    }

    #[Route('/teachers/getSchedule/{id}', name: 'teachers_getSchedule')]
    public function getSchedule(int $id): Response
    {
        if (!$id) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        $schedule = $this->scheduleRepository->findByTeacherId($id);
        return $this->json($schedule);
    }

    #[Route('/teachers/getSubjects/{id}', name: 'teachers_getSubjects')]
    public function getSubjects(int $id): Response
    {
        $teacher = $this->teachersRepository->find($id);

        if (!$teacher) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        $subjectIds = $teacher->getSubjectIds();
        $results = [];
       
        foreach ($subjectIds as $subjectId) {
            $subject = $this->subjectsRepository->find($subjectId);
            if($subject) {
                $results[] = [
                    'id' => $subjectId,
                    'name' => $subject->getName()
                ];
            }
        }
        return $this->json($results);
    }

    #[Route('/teachers/getQualifications/{id}', name: 'teachers_getQualifications')]
    public function getQualifications(int $id): Response
    {
        $teacher = $this->teachersRepository->find($id);

        if (!$teacher) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        $qualificationIds = $teacher->getQualificationIds();
        $results = [];
       
        foreach ($qualificationIds as $qualificationId) {
            $qualification = $this->qualificationsRepository->find($qualificationId);
            if($qualification) {
                $results[] = [
                    'id' => $qualificationId,
                    'name' => $qualification->getName()
                ];
            }
        }
        return $this->json($results);
    }

    #[Route('/teachers/getGrades/{id}', name: 'teachers_getGrades')]
    public function getGrades(int $id): Response
    {
        $teacher = $this->teachersRepository->find($id);

        if (!$teacher) {
            return $this->json(['message' => 'Teacher not found'], Response::HTTP_NOT_FOUND);
        }

        $gradeIds = $teacher->getGradeIds();
        $results = [];
       
        foreach ($gradeIds as $gradeId) {
            $grade = $this->subjectsRepository->find($gradeId);
            if($grade) {
                $results[] = [
                    'id' => $gradeId,
                    'name' => $grade->getName()
                ];
            }
        }
        return $this->json($results);
    }
}
