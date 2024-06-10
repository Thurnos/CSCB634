<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Repository\AttendanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttendanceController extends AbstractController
{
    private $entityManager;
    private $attendanceRepository;

    public function __construct(EntityManagerInterface $entityManager, AttendanceRepository $attendanceRepository)
    {
        $this->entityManager = $entityManager;
        $this->attendanceRepository = $attendanceRepository;
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

        return $this->json($attendance);
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

        return $this->json($attendanceRecords);
    }
}

