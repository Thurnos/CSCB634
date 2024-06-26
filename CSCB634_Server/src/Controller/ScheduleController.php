<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Repository\ScheduleRepository;
use App\Repository\StudentsRepository;
use App\Repository\SubjectsRepository;
use App\Repository\TeachersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    private $entityManager;
    private $scheduleRepository;
    private $subjectsRepository;
    private $teachersRepository;
    private $studentsRepository;

    public function __construct(EntityManagerInterface $entityManager, ScheduleRepository $scheduleRepository,SubjectsRepository $subjectsRepository,TeachersRepository $teachersRepository,StudentsRepository $studentsRepository)
    {
        $this->entityManager = $entityManager;
        $this->scheduleRepository = $scheduleRepository;
        $this->subjectsRepository = $subjectsRepository;
        $this->teachersRepository = $teachersRepository;
        $this->studentsRepository = $studentsRepository;
    }

    #[Route('/schedule/list', name: 'schedule_list')]
    public function list(): JsonResponse
    {
        $schedules = $this->scheduleRepository->findAll();

        $result = [];
        foreach ($schedules as $schedule){
            $teacher = null;
            $student = null;
            if($schedule->getTeacherId())
                $teacher =$this->teachersRepository->find($schedule->getTeacherId());
            else if($schedule->getStudentId())
                $student = $this->studentsRepository->find($schedule->getStudentId());

            $getSubjectsForDay = function($subjectIds) {
                $subjects = array_map(function($subjectId) {
                    return $this->subjectsRepository->find($subjectId);
                }, $subjectIds);

                // Filter out any null values in case a subject was not found
                $subjects = array_filter($subjects);

                // Format the subjects
                return array_map(function($subject) {
                    return [
                        'id' => $subject->getId(),
                        'name' => $subject->getName()
                    ];
                }, $subjects);
            };

            $result[] = [
                'id' => $schedule->getId(),
                'school_id' => $schedule->getSchoolId(),
                'student'=>$student ? [
                    'id'=>$student->getId(),
                    'name'=>$student->getName(),
                ] : null,
                'teacher'=>$teacher ? [
                    'id'=>$teacher->getId(),
                    'name'=>$teacher->getName(),
                ] : null,
                'monday'=>$getSubjectsForDay($schedule->getMonday()),
                'tuesday'=>$getSubjectsForDay($schedule->getTuesday()),
                'wednesday'=>$getSubjectsForDay($schedule->getWednesday()),
                'thursday'=>$getSubjectsForDay($schedule->getThursday()),
                'friday' =>$getSubjectsForDay($schedule->getFriday())
                ];

        }
        return $this->json($result);
    }

    #[Route('/schedule/listBySchool/{id}', name: 'schedule_listBySchool')]
    public function listBySchool(int $id): JsonResponse
    {
        $schedules = $this->scheduleRepository->findBySchoolId($id);

        $result = [];
        foreach ($schedules as $schedule){
            $teacher = null;
            $student = null;
            if($schedule->getTeacherId())
                $teacher =$this->teachersRepository->find($schedule->getTeacherId());
            else if($schedule->getStudentId())
                $student = $this->studentsRepository->find($schedule->getStudentId());

            $getSubjectsForDay = function($subjectIds) {
                $subjects = array_map(function($subjectId) {
                    return $this->subjectsRepository->find($subjectId);
                }, $subjectIds);

                // Filter out any null values in case a subject was not found
                $subjects = array_filter($subjects);

                // Format the subjects
                return array_map(function($subject) {
                    return [
                        'id' => $subject->getId(),
                        'name' => $subject->getName()
                    ];
                }, $subjects);
            };

            $result[] = [
                'id' => $schedule->getId(),
                'school_id' => $schedule->getSchoolId(),
                'student'=>$student ? [
                    'id'=>$student->getId(),
                    'name'=>$student->getName(),
                ] : null,
                'teacher'=>$teacher ? [
                    'id'=>$teacher->getId(),
                    'name'=>$teacher->getName(),
                ] : null,
                'monday'=>$getSubjectsForDay($schedule->getMonday()),
                'tuesday'=>$getSubjectsForDay($schedule->getTuesday()),
                'wednesday'=>$getSubjectsForDay($schedule->getWednesday()),
                'thursday'=>$getSubjectsForDay($schedule->getThursday()),
                'friday' =>$getSubjectsForDay($schedule->getFriday())
            ];

        }
        return $this->json($result);
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