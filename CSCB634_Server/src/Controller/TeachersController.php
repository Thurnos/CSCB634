<?php

namespace App\Controller;

use App\Entity\Teachers;
use App\Repository\TeachersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TeachersController extends AbstractController
{
    private $entityManager;
    private $teachersRepository;

    public function __construct(EntityManagerInterface $entityManager, TeachersRepository $teachersRepository)
    {
        $this->entityManager = $entityManager;
        $this->teachersRepository = $teachersRepository;
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
        $teacher->setGradeId($data['grade_id'] ?? null);
        $teacher->setSubjectId($data['subject_id'] ?? null);
        $teacher->setSubjectsList($data['subjects_list'] ?? '');

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
    public function update(Request $request, int $id): Response
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
        $teacher->setGradeId($data['grade_id'] ?? $teacher->getGradeId());
        $teacher->setSubjectId($data['subject_id'] ?? $teacher->getSubjectId());
        $teacher->setSubjectsList($data['subjects_list'] ?? $teacher->getSubjectsList());

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
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $teachers = $this->teachersRepository->findAll();

        return $this->json($serializer->serialize($teachers, 'json'));
    }

    //TODO update grades and attendance
}
