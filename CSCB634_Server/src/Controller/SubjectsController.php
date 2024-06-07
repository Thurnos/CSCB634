<?php

namespace App\Controller;

use App\Entity\Subjects;
use App\Repository\SubjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SubjectsController extends AbstractController
{
    private $entityManager;
    private $subjectsRepository;

    public function __construct(EntityManagerInterface $entityManager, SubjectsRepository $subjectsRepository)
    {
        $this->entityManager = $entityManager;
        $this->subjectsRepository = $subjectsRepository;
    }

    #[Route('/subjects/add', name: 'subject_add')]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $subject = new Subjects();
        $subject->setName($data['name']);

        $this->entityManager->persist($subject);
        $this->entityManager->flush();

        return $this->json($subject);
    }

    #[Route('/subjects/show/{id}', name: 'subject_show')]
    public function show($id): Response
    {
        $subject = $this->subjectsRepository->find($id);

        if (!$subject) {
            return $this->json(['message' => 'Subject not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($subject);
    }

    #[Route('/subjects/list', name: 'subject_list')]
    public function list(): Response
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $subjects = $this->subjectsRepository->findAll();

        return $this->json($serializer->serialize($subjects, 'json'));
    }

    #[Route('/subjects/edit/{id}', name: 'subject_edit')]
    public function edit(Request $request, $id): Response
    {
        $subject = $this->subjectsRepository->find($id);

        if (!$subject) {
            return $this->json(['message' => 'Subject not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $subject->setName($data['name']);

        $this->entityManager->flush();

        return $this->json($subject);
    }

    #[Route('/subjects/delete/{id}', name: 'subject_delete')]
    public function delete($id): Response
    {
        $subject = $this->subjectsRepository->find($id);

        if (!$subject) {
            return $this->json(['message' => 'Subject not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($subject);
        $this->entityManager->flush();

        return $this->json(['message' => 'Subject deleted successfully']);
    }
}
