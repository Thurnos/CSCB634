<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SubjectsControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddSubject()
    {
        $client = static::createClient();

        $client->request('POST', '/subjects/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Mathematics',
            'school_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Subject created successfully', $client->getResponse()->getContent());
    }

    public function testListSubjects()
    {
        $client = static::createClient();

        // Ensure there is at least one subject to list
        $client->request('POST', '/subjects/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Science',
            'school_id' => 1
        ]));

        // List subjects
        $client->request('GET', '/subjects/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('"name":"Science"', $client->getResponse()->getContent());
    }

    public function testEditSubject()
    {
        $client = static::createClient();

        // First, create a subject to edit
        $client->request('POST', '/subjects/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'History',
            'school_id' => 1
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $subjectId = $responseContent['id']; // Assuming the response contains the subject ID

        // Now, edit the subject
        $client->request('POST', '/subjects/edit/' . $subjectId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'World History',
            'school_id' => 2
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('World History', $client->getResponse()->getContent());
    }

    public function testDeleteSubject()
    {
        $client = static::createClient();

        // First, create a subject to delete
        $client->request('POST', '/subjects/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Geography',
            'school_id' => 1
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $subjectId = $responseContent['id']; // Assuming the response contains the subject ID

        // Now, delete the subject
        $client->request('DELETE', '/subjects/delete/' . $subjectId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Subject deleted successfully', $client->getResponse()->getContent());
    }
}
