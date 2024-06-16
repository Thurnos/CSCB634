<?php

namespace App\Controller;

use App\Repository\AttendanceRepository;
use App\Repository\MarksRepository;
use App\Repository\ParentsRepository;
use App\Repository\RoleRepository;
use App\Repository\StudentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RolesController extends AbstractController
{
    private $entityManager;
    private $roleRepository;
    public function __construct(EntityManagerInterface $entityManager,RoleRepository $roleRepository)
    {
        $this->entityManager = $entityManager;
        $this->roleRepository = $roleRepository;
    }

    #[Route('/roles/list', name: 'roles_list')]
    public function list(): Response
    {
        $roles = $this->roleRepository->findAll();

        return $this->json($roles);
    }

    #[Route('/roles/getRole/{id}', name: 'roles_getRole')]
    public function getRole(int $id): Response
    {
        $role = $this->roleRepository->find($id);

        if (!$role) {
            return $this->json(['message' => 'Role not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($role);
    }
}