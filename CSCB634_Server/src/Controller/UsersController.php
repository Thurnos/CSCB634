<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationDto
{
    private $username;
    private $password;
    private $role;

    public function __construct(array $data)
    {
        $this->username = $data['username'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->role = $data['role'] ?? '';
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}

class UsersController extends AbstractController
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/login', name: 'login')]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            return new JsonResponse(['error' => 'Invalid credentials'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->entityManager->getRepository(Users::class)->findOneBy(['username' => $username]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Invalid password'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'success' => 'Login successful',
            'role' => $user->getRole()
        ], JsonResponse::HTTP_OK);
    }

    #[Route('/addUser', name: 'addUser')]
    public function addUser(Request $request): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $userDto = new UserRegistrationDto($data);

        // Validate $userDto

        $existingUser = $this->entityManager->getRepository(Users::class)->findOneBy(['username' => $userDto->getUsername()]);

        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already exists'], JsonResponse::HTTP_CONFLICT);
        }

        $user = new Users();
        $user->setUsername($userDto->getUsername());
        $hashedPassword = $this->passwordHasher->hashPassword($user, $userDto->getPassword());
        $user->setPassword($hashedPassword);
        $user->setRole((int)$userDto->getRole());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['success' => 'User created successfully'], JsonResponse::HTTP_CREATED);
    }
}
