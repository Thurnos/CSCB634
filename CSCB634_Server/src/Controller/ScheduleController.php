<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    private $entityManager;
    private $scheduleRepository;

    public function __construct(EntityManagerInterface $entityManager, ScheduleRepository $scheduleRepository)
    {
        $this->entityManager = $entityManager;
        $this->scheduleRepository = $scheduleRepository;
    }

    #[Route('/schedule/list', name: 'schedule_list')]
    public function list(): JsonResponse
    {
        $schedules = $this->scheduleRepository->findAll();
        return $this->json($schedules);
    }

    #[Route('/schedule/get/{id}', name: 'schedule_get')]
    public function getSchedule(int $id): JsonResponse
    {
        $schedule = $this->scheduleRepository->find($id);
        if (!$schedule) {
            return $this->json(['message' => 'Schedule not found'], 404);
        }
        return $this->json($schedule);
    }

    #[Route('/schedule/add', name: 'schedule_add')]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $schedule = new Schedule();
        $schedule->setSchoolId($data['school_id']);
        $schedule->setStudentId($data['student_id'] ?? null);
        $schedule->setTeacherId($data['teacher_id'] ?? null);
        $schedule->setMonday($data['monday'] ?? []);
        $schedule->setTuesday($data['tuesday'] ?? []);
        $schedule->setWednesday($data['wednesday'] ?? []);
        $schedule->setThursday($data['thursday'] ?? []);
        $schedule->setFriday($data['friday'] ?? []);

        $this->entityManager->persist($schedule);
        $this->entityManager->flush();

        return $this->json(['message' => 'Schedule created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/schedule/edit/{id}', name: 'schedule_edit')]
    public function edit(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $schedule = $this->scheduleRepository->find($id);
        if (!$schedule) {
            return $this->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->setSchoolId($data['school_id'] ?? $schedule->getSchoolId());
        $schedule->setStudentId($data['student_id'] ?? $schedule->getStudentId());
        $schedule->setTeacherId($data['teacher_id'] ?? $schedule->getTeacherId());
        $schedule->setMonday($data['monday'] ?? $schedule->getMonday());
        $schedule->setTuesday($data['tuesday'] ?? $schedule->getTuesday());
        $schedule->setWednesday($data['wednesday'] ?? $schedule->getWednesday());
        $schedule->setThursday($data['thursday'] ?? $schedule->getThursday());
        $schedule->setFriday($data['friday'] ?? $schedule->getFriday());

        $this->entityManager->flush();

        return $this->json($schedule);
    }

    #[Route('/schedule/delete/{id}', name: 'schedule_delete')]
    public function deleteSchedule(int $id): JsonResponse
    {
        $schedule = $this->scheduleRepository->find($id);
        if (!$schedule) {
            return $this->json(['message' => 'Schedule not found'], 404);
        }

        $this->entityManager->remove($schedule);
        $this->entityManager->flush();

        return $this->json(['message' => 'Schedule deleted']);
    }
}