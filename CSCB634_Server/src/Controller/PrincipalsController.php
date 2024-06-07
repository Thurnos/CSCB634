<?php

namespace App\Controller;

use App\Entity\Principals;
use App\Repository\PrincipalsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PrincipalsController extends AbstractController
{
    private $entityManager;
    private $principalsRepository;

    public function __construct(EntityManagerInterface $entityManager, PrincipalsRepository $principalsRepository)
    {
        $this->entityManager = $entityManager;
        $this->principalsRepository = $principalsRepository;
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
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $principals = $this->principalsRepository->findAll();

        return $this->json($serializer->serialize($principals, 'json'));
    }
}

