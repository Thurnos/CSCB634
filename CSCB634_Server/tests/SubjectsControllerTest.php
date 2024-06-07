<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Subjects;
use Doctrine\ORM\EntityManagerInterface;

class SubjectsControllerTest extends WebTestCase
{
    private $client;
    private $entityManager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();
    }

    public function testIndex(): void
    {
        $this->client->request('GET', '/subjects/');
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testCreateNewSubject(): void
    {
        $this->client->request(
            'POST',
            '/subjects/new',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['name' => 'Test Subjects'])
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $subject = $this->entityManager->getRepository(Subjects::class)->findOneBy(['name' => 'Test Subjects']);
        $this->assertNotNull($subject);
    }

    public function testShowSubject(): void
    {
        $subject = new Subjects();
        $subject->setName('Test Show Subjects');
        $this->entityManager->persist($subject);
        $this->entityManager->flush();

        $this->client->request('GET', '/subjects/' . $subject->getId());
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $responseContent = $this->client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        $this->assertEquals('Test Show Subjects', $responseData['name']);
    }

    public function testEditSubject(): void
    {
        $subject = new Subjects();
        $subject->setName('Test Edit Subjects');
        $this->entityManager->persist($subject);
        $this->entityManager->flush();

        $this->client->request(
            'PUT',
            '/subjects/' . $subject->getId() . '/edit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['name' => 'Updated Subjects'])
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $updatedSubject = $this->entityManager->getRepository(Subjects::class)->find($subject->getId());
        $this->assertEquals('Updated Subjects', $updatedSubject->getName());
    }

    public function testDeleteSubject(): void
    {
        $subject = new Subjects();
        $subject->setName('Test Delete Subject');
        $this->entityManager->persist($subject);
        $this->entityManager->flush();

        $this->client->request('DELETE', '/subjects/' . $subject->getId());
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $deletedSubject = $this->entityManager->getRepository(Subjects::class)->find($subject->getId());
        $this->assertNull($deletedSubject);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}