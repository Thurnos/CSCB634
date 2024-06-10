<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SchoolsControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddSchool()
    {
        $client = static::createClient();

        $client->request('POST', '/schools/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test School',
            'address' => '123 Test Street'
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('School created successfully', $client->getResponse()->getContent());
    }

    public function testListSchools()
    {
        $client = static::createClient();

        // Ensure there is at least one school to list
        $client->request('POST', '/schools/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Another Test School',
            'address' => '456 Test Avenue'
        ]));

        // List schools
        $client->request('GET', '/schools/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('"name":"Another Test School"', $client->getResponse()->getContent());
    }

    public function testEditSchool()
    {
        $client = static::createClient();

        // First, create a school to edit
        $client->request('POST', '/schools/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Old School',
            'address' => '789 Old Avenue'
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $schoolId = $responseContent['id']; // Assuming the response contains the school ID

        // Now, edit the school
        $client->request('POST', '/schools/edit/' . $schoolId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'New School',
            'address' => '789 New Avenue'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('New School', $client->getResponse()->getContent());
    }

    public function testDeleteSchool()
    {
        $client = static::createClient();

        // First, create a school to delete
        $client->request('POST', '/schools/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'School to Delete',
            'address' => '789 Delete Lane'
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $schoolId = $responseContent['id']; // Assuming the response contains the school ID

        // Now, delete the school
        $client->request('DELETE', '/schools/delete/' . $schoolId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('School deleted successfully', $client->getResponse()->getContent());
    }
}
