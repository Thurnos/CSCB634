<?php

// src/Controller/MarksController.php

namespace App\Controller;

use App\Entity\Marks;
use App\Repository\MarksRepository;
use App\Repository\StudentsRepository;
use App\Repository\SubjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarksController extends AbstractController
{
    private $entityManager;
    private $marksRepository;
    private $studentsRepository;
    private $subjectsRepository;

    public function __construct(EntityManagerInterface $entityManager, MarksRepository $marksRepository,StudentsRepository $studentsRepository,SubjectsRepository $subjectsRepository)
    {
        $this->entityManager = $entityManager;
        $this->marksRepository = $marksRepository;
        $this->studentsRepository = $studentsRepository;
        $this->subjectsRepository=$subjectsRepository;
    }

    #[Route('/marks/add', name: 'marks_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $mark = new Marks();
        $mark->setMark($data['mark'] ?? null);
        $mark->setDate(new \DateTime($data['date'] ?? 'now'));
        $mark->setStudentId($data['student_id']);
        $mark->setSubjectId($data['subject_id']);

        $this->entityManager->persist($mark);
        $this->entityManager->flush();

        return $this->json(['message' => 'Mark created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/marks/getMark/{id}', name: 'marks_getMark')]
    public function getMark(int $id): Response
    {
        $mark = $this->marksRepository->find($id);

        if (!$mark) {
            return $this->json(['message' => 'Mark not found'], Response::HTTP_NOT_FOUND);
        }

        $result = [];
        $student = $this->studentsRepository->find($mark->getStudentId());
        $subject = $this->subjectsRepository->find($mark->getSubjectId());

            $result[] = [
                'id' => $mark->getId(),
                'mark' => $mark->getMark(),
                'date' => $mark->getDate(),
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student->getName(),
                    'number' => $student->getNumber(),
                    'email' => $student->getEmail(),
                ],
                'subject' => [
                    'id' => $subject->getId(),
                    'name' => $subject->getName(),
                    'school' => $subject->getSchoolId()
                ]
            ];
        return $this->json($result);
    }

    #[Route('/marks/edit/{id}', name: 'marks_edit')]
    public function edit(Request $request, int $id): Response
    {
        $mark = $this->marksRepository->find($id);

        if (!$mark) {
            return $this->json(['message' => 'Mark not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $mark->setMark($data['mark'] ?? $mark->getMark());
        $mark->setDate(new \DateTime($data['date'] ?? $mark->getDate()->format('Y-m-d')));
        $mark->setStudentId($data['student_id'] ?? $mark->getStudentId());
        $mark->setSubjectId($data['subject_id'] ?? $mark->getSubjectId());

        $this->entityManager->flush();

        return $this->json(['message' => 'Mark updated successfully']);
    }

    #[Route('/marks/delete/{id}', name: 'marks_delete')]
    public function delete(int $id): Response
    {
        $mark = $this->marksRepository->find($id);

        if (!$mark) {
            return $this->json(['message' => 'Mark not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($mark);
        $this->entityManager->flush();

        return $this->json(['message' => 'Mark deleted successfully']);
    }

    #[Route('/marks/list', name: 'marks_list')]
    public function list(): Response
    {
        $marks = $this->marksRepository->findAll();

        $result = [];

        foreach ($marks as $mark) {
            $student = $this->studentsRepository->find($mark->getStudentId());
            $subject = $this->subjectsRepository->find($mark->getSubjectId());

            $result[] = [
                'id' => $mark->getId(),
                'mark' => $mark->getMark(),
                'date' => $mark->getDate(),
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student->getName(),
                    'number' => $student->getNumber(),
                    'email' => $student->getEmail(),
                ],
                'subject' => [
                    'id' => $subject->getId(),
                    'name' => $subject->getName(),
                    'school' => $subject->getSchoolId()
                ]
            ];
        }
        return $this->json($result);
    }

    #[Route('/marks/student/list/{id}', name: 'marks_student_list')]
    public function studentMarksList(int $id): Response
    {
        $marks = $this->marksRepository->findByStudentId($id);

        $result = [];

        foreach ($marks as $mark) {
            $student = $this->studentsRepository->find($mark->getStudentId());
            $subject = $this->subjectsRepository->find($mark->getSubjectId());

            $result[] = [
                'id' => $mark->getId(),
                'mark' => $mark->getMark(),
                'date' => $mark->getDate(),
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student->getName(),
                    'number' => $student->getNumber(),
                    'email' => $student->getEmail(),
                ],
                'subject' => [
                    'id' => $subject->getId(),
                    'name' => $subject->getName(),
                    'school' => $subject->getSchoolId()
                ]
            ];
        }
        return $this->json($result);
    }

    #[Route('/marks/subject/list/{id}', name: 'marks_subject_list')]
    public function subjectMarksList(int $id): Response
    {
        $marks = $this->marksRepository->findBySubjectId($id);
        $result = [];

        foreach ($marks as $mark) {
            $student = $this->studentsRepository->find($mark->getStudentId());
            $subject = $this->subjectsRepository->find($mark->getSubjectId());

            $result[] = [
                'id' => $mark->getId(),
                'mark' => $mark->getMark(),
                'date' => $mark->getDate(),
                'student' => [
                    'id' => $student->getId(),
                    'name' => $student->getName(),
                ],
                'subject' => [
                    'id' => $subject->getId(),
                    'name' => $subject->getName(),
                ]
            ];
        }
        return $this->json($result);
    }
}
