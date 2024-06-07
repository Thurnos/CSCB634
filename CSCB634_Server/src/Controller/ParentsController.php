<?php

namespace App\Controller;

use App\Entity\Parents;
use App\Repository\ParentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ParentsController extends AbstractController
{
    private $entityManager;
    private $parentsRepository;

    public function __construct(EntityManagerInterface $entityManager, ParentsRepository $parentsRepository)
    {
        $this->entityManager = $entityManager;
        $this->parentsRepository = $parentsRepository;
    }

    #[Route('/parents/add', name: 'parents_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $parent = new Parents();
        $parent->setName($data['name'] ?? null);
        $parent->setEmail($data['email'] ?? null);
        $parent->setNumber($data['number'] ?? null);

        $this->entityManager->persist($parent);
        $this->entityManager->flush();

        return $this->json(['message' => 'Parent created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/parents/getParent', name: 'parents_getParent')]
    public function getParent(int $id): Response
    {
        $parent = $this->parentsRepository->find($id);

        if (!$parent) {
            return $this->json(['message' => 'Parent not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($parent);
    }

    #[Route('/parents/edit/{id}', name: 'parents_edit')]
    public function edit(Request $request, int $id): Response
    {
        $parent = $this->parentsRepository->find($id);

        if (!$parent) {
            return $this->json(['message' => 'Parent not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $parent->setName($data['name'] ?? $parent->getName());
        $parent->setEmail($data['email'] ?? $parent->getEmail());
        $parent->setNumber($data['number'] ?? $parent->getNumber());

        $this->entityManager->flush();

        return $this->json(['message' => 'Parent updated successfully']);
    }

    #[Route('/parents/delete/{id}', name: 'parents_delete')]
    public function delete(int $id): Response
    {
        $parent = $this->parentsRepository->find($id);

        if (!$parent) {
            return $this->json(['message' => 'Parent not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($parent);
        $this->entityManager->flush();

        return $this->json(['message' => 'Parent deleted successfully']);
    }

    #[Route('/parents/list', name: 'parents_list')]
    public function list(): Response
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $parents = $this->parentsRepository->findAll();

        return $this->json($serializer->serialize($parents, 'json'));
    }
}

