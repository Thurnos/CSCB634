<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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

    #[Route('/users/login', name: 'users_login')]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            return new JsonResponse(['error' => 'Username or password is missing'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->entityManager->getRepository(Users::class)->findOneBy(['username' => $username]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Incorrect password'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'success' => 'Login successful',
            'role' => $user->getRole(),
            'username' => $user->getUsername(),
            'id' => $user->getId(),
            'email' => $user->getEmail(),
        ], JsonResponse::HTTP_OK);
    }

    #[Route('/users/add', name: 'users_add')]
    public function add(Request $request): JsonResponse
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

    #[Route('/users/edit/{id}', name: 'users_edit',methods: ['PUT'])]
    public function edit(Request $request, int $id): Response
    {
        $existingUser = $this->entityManager->getRepository(Users::class)->find($id);

        if (!$existingUser)
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);


        $data = json_decode($request->getContent(), true);
        $existingUser->setUsername($data['username'] ?? $existingUser->getUsername());


        if(isset($data['password']) && $data['password']){
            $hashedPassword = $this->passwordHasher->hashPassword($existingUser, $data['password']);
            $existingUser->setPassword($hashedPassword);
        }

        $this->entityManager->flush();

        return $this->json(['message' => 'User updated successfully']);
    }
    #[Route('/users/delete/{id}', name: 'users_delete')]
    public function delete(int $id): JsonResponse
    {
        $user = $this->entityManager->getRepository(Users::class)->find($id);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new JsonResponse(['success' => 'User deleted successfully'], JsonResponse::HTTP_OK);
    }

    #[Route('/users/getRole/{id}', name: 'users_getRole')]
    public function getRole(int $id): JsonResponse
    {
        $user = $this->entityManager->getRepository(Users::class)->find($id);

        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(['role' => $user->getRole()]);
    }

    #[Route('/users/setRole/{id}', name: 'users_setRole')]
    public function changeRole(Request $request, int $id): JsonResponse
    {
        $user = $this->entityManager->getRepository(Users::class)->find($id);

        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (!isset($data['role'])) {
            return $this->json(['message' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
        }
        
        $role = $data['role'];
        $user->setRole($role);
        $this->entityManager->flush();

        return $this->json(['message' => 'Role updated successfully']);
    }

    #[Route('/users/list', name: 'users_list')]
    public function list(): JsonResponse
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $users = $this->entityManager->getRepository(Users::class)->findAll();        
        return $this->json($serializer->serialize($users, 'json'));
    }

}
