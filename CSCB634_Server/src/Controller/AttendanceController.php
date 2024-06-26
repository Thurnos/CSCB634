<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Repository\AttendanceRepository;
use App\Repository\StudentsRepository;
use App\Repository\SubjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttendanceController extends AbstractController
{
    private $entityManager;
    private $attendanceRepository;
    private $studentsRepository;
    private $subjectsRepository;

    public function __construct(EntityManagerInterface $entityManager, AttendanceRepository $attendanceRepository,StudentsRepository $studentsRepository,SubjectsRepository $subjectsRepository)
    {
        $this->entityManager = $entityManager;
        $this->attendanceRepository = $attendanceRepository;
        $this->studentsRepository = $studentsRepository;
        $this->subjectsRepository = $subjectsRepository;
    }

    #[Route('/attendance/add', name: 'attendance_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $attendance = new Attendance();
        $attendance->setDate(new \DateTime($data['date']) ?? null);
        $attendance->setStatus($data['status'] ?? null);
        $attendance->setStudentId($data['student_id']);
        $attendance->setSubjectId($data['subject_id']);

        $this->entityManager->persist($attendance);
        $this->entityManager->flush();

        return $this->json(['message' => 'Attendance record created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/attendance/getAttendance/{id}', name: 'attendance_getAttendance')]
    public function getAttendance(int $id): Response
    {
        $attendance = $this->attendanceRepository->find($id);

        if (!$attendance) {
            return $this->json(['message' => 'Attendance record not found'], Response::HTTP_NOT_FOUND);
        }

        $subject = $this->subjectsRepository->find($attendance->getSubjectId());
        $student = $this->studentsRepository->find($attendance->getStudentId());

        $result[] = [
            'id' => $attendance->getId(),
            'date' => $attendance->getDate(),
            'status' => $attendance->getStatus(),
            'subject' => [
                'id' => $subject->getId(),
                'name' => $subject ? $subject->getName() : ''
            ],
            'student' => [
                'id' => $student->getId(),
                'name' => $student ? $student->getName() : ''
            ]
        ];
        return $this->json($result);
    }

    #[Route('/attendance/edit/{id}', name: 'attendance_edit')]
    public function edit(Request $request, int $id): Response
    {
        $attendance = $this->attendanceRepository->find($id);

        if (!$attendance) {
            return $this->json(['message' => 'Attendance record not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $attendance->setDate(new \DateTime($data['date'] ?? $attendance->getDate()->format('Y-m-d')));
        $attendance->setStatus($data['status'] ?? $attendance->getStatus());
        $attendance->setStudentId($data['student_id'] ?? $attendance->getStudentId());
        $attendance->setSubjectId($data['subject_id'] ?? $attendance->getSubjectId());

        $this->entityManager->flush();

        return $this->json(['message' => 'Attendance record updated successfully']);
    }

    #[Route('/attendance/delete/{id}', name: 'attendance_delete')]
    public function delete(int $id): Response
    {
        $attendance = $this->attendanceRepository->find($id);

        if (!$attendance) {
            return $this->json(['message' => 'Attendance record not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($attendance);
        $this->entityManager->flush();

        return $this->json(['message' => 'Attendance record deleted successfully']);
    }

    #[Route('/attendance/list', name: 'attendance_list')]
    public function list(): Response
    {
        $attendanceRecords = $this->attendanceRepository->findAll();
        $result = [];

        foreach ($attendanceRecords as $attendance) {
            $subject = $this->subjectsRepository->find($attendance->getSubjectId());
            $student = $this->studentsRepository->find($attendance->getStudentId());

            $result[] = [
                'id' => $attendance->getId(),
                'date' => $attendance->getDate(),
                'status' => $attendance->getStatus(),
                'subject' => [
                    'id' => $subject->getId(),
                    'name' => $subject ? $subject->getName() : '',
                    'school'=>$subject ? $subject->getSchoolId() : ''
                ],
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student ? $student->getName() : ''
                ]
            ];
        }
        return $this->json($result);
    }
    #[Route('/attendance/student/list/{id}', name: 'attendance_student_list')]
    public function getAttendacesForStudent(int $id): Response
    {
        $attendanceRecords = $this->attendanceRepository->findByStudentId($id);
        $result = [];

        foreach ($attendanceRecords as $attendance) {
            $subject = $this->subjectsRepository->find($attendance->getSubjectId());
            $student = $this->studentsRepository->find($attendance->getStudentId());

            $result[] = [
                'id' => $attendance->getId(),
                'date' => $attendance->getDate(),
                'status' => $attendance->getStatus(),
                'subject' => [
                    'id' => $subject->getId(),
                    'name' => $subject ? $subject->getName() : ''
                ],
            ];
        }
        return $this->json($result);
    }
    #[Route('/attendance/subject/list/{id}', name: 'attendance_subject_list')]
    public function getAttendancesForSubject(int $id): Response
    {
        $attendanceRecords = $this->attendanceRepository->findBySubjectId($id);
        $result = [];

        foreach ($attendanceRecords as $attendance) {
            $subject = $this->subjectsRepository->find($attendance->getSubjectId());
            $student = $this->studentsRepository->find($attendance->getStudentId());

            $result[] = [
                'id' => $attendance->getId(),
                'date' => $attendance->getDate(),
                'status' => $attendance->getStatus(),
                'subject' => [
                    'id' => $subject->getId(),
                    'name' => $subject ? $subject->getName() : ''
                ],
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student ? $student->getName() : ''
                ]
            ];
        }
        return $this->json($result);
    }
}

