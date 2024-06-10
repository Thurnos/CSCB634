<?php

namespace App\Controller;

use App\Entity\Principals;
use App\Repository\PrincipalsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TeachersRepository;
use App\Repository\StudentsRepository;
use App\Repository\SubjectsRepository;
use App\Repository\ParentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalsController extends AbstractController
{
    private $entityManager;
    private $principalsRepository;
    private $studentsRepository;
    private $subjectsRepository;
    private $teachersRepository;
    private $parentsRepository;

    public function __construct(EntityManagerInterface $entityManager, PrincipalsRepository $principalsRepository,
    StudentsRepository $studentsRepository, SubjectsRepository $subjectsRepository, TeachersRepository $teachersRepository, ParentsRepository $parentsRepository)
    {
        $this->entityManager = $entityManager;
        $this->principalsRepository = $principalsRepository;
        $this->studentsRepository = $studentsRepository;
        $this->subjectsRepository = $subjectsRepository;
        $this->teachersRepository = $teachersRepository;
        $this->parentsRepository = $parentsRepository;
    }

    #[Route('/principals/add', name: 'principals_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $principal = new Principals();
        $principal->setName($data['name'] ?? null);
        $principal->setEmail($data['email'] ?? null);
        $principal->setSchoolId($data['school_id'] ?? null);

        $this->entityManager->persist($principal);
        $this->entityManager->flush();

        return $this->json(['message' => 'Principal created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/principals/getPrincipal/{id}', name: 'principals_getPrincipal')]
    public function getPrincipal(int $id): Response
    {
        $principal = $this->principalsRepository->find($id);

        if (!$principal) {
            return $this->json(['message' => 'Principal not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($principal);
    }

    #[Route('/principals/edit/{id}', name: 'principals_edit')]
    public function edit(Request $request, int $id): Response
    {
        $principal = $this->principalsRepository->find($id);

        if (!$principal) {
            return $this->json(['message' => 'Principal not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $principal->setName($data['name'] ?? $principal->getName());
        $principal->setEmail($data['email'] ?? $principal->getEmail());
        $principal->setSchoolId($data['school_id'] ?? $principal->getSchoolId());

        $this->entityManager->flush();

        return $this->json(['message' => 'Principal updated successfully']);
    }

    #[Route('/principals/delete/{id}', name: 'principals_delete')]
    public function delete(int $id): Response
    {
        $principal = $this->principalsRepository->find($id);

        if (!$principal) {
            return $this->json(['message' => 'Principal not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($principal);
        $this->entityManager->flush();

        return $this->json(['message' => 'Principal deleted successfully']);
    }

    #[Route('/principals/list', name: 'principals_list')]
    public function list(): Response
    {
        $principals = $this->principalsRepository->findAll();

        return $this->json($principals);
    }

    #[Route('/principals/getStudents/{id}', name: 'principals_students')]
    public function getStudents(int $id): Response
    {
        $principal = $this->principalsRepository->find($id);

        if (!$principal) {
            return $this->json(['message' => 'Principal not found'], Response::HTTP_NOT_FOUND);
        }

        $schoolId = $principal->getSchoolId();

        if (!$schoolId) {
            return $this->json(['message' => 'School not found'], Response::HTTP_NOT_FOUND);
        }

        $results = [];

        $students = $this->studentsRepository->findBySchoolId($schoolId);
        return $this->json($students);
    }

    #[Route('/principals/getSubjects/{id}', name: 'principals_subjects')]
    public function getSubjects(int $id): Response
    {
        $principal = $this->principalsRepository->find($id);

        if (!$principal) {
            return $this->json(['message' => 'Principal not found'], Response::HTTP_NOT_FOUND);
        }

        $schoolId = $principal->getSchoolId();

        if (!$schoolId) {
            return $this->json(['message' => 'School not found'], Response::HTTP_NOT_FOUND);
        }

        $results = [];

        $subjects = $this->subjectsRepository->findBySchoolId($schoolId);
        return $this->json($subjects);
    }

    #[Route('/principals/getTeachers/{id}', name: 'principals_teachers')]
    public function getTeachers(int $id): Response
    {
        $principal = $this->principalsRepository->find($id);

        if (!$principal) {
            return $this->json(['message' => 'Principal not found'], Response::HTTP_NOT_FOUND);
        }

        $schoolId = $principal->getSchoolId();

        if (!$schoolId) {
            return $this->json(['message' => 'School not found'], Response::HTTP_NOT_FOUND);
        }

        $results = [];

        $teachers = $this->teachersRepository->findBySchoolId($schoolId);
        return $this->json($teachers);
    }

    #[Route('/principals/getParents/{id}', name: 'principals_parents')]
    public function getParents(int $id): Response
    {
        $students = json_decode($this->getStudents($id)->getContent(), true);
        $results = [];

        foreach ($students as $student) { 
            $parentIds = $student["parentIds"];

            foreach ($parentIds as $parentId) {
                $parent = $this->parentsRepository->find($parentId);

                if($parent) {
                    $results[] = [
                        'id' => $parentId,
                        'name' => $parent->getName(),
                        'email' => $parent->getEmail(),
                        'number' => $parent->getNumber(),
                    ];
                }
            }
        }

        return $this->json($results);
    }
}
