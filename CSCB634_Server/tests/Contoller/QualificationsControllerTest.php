<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class QualificationsControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddQualification()
    {
        $client = static::createClient();

        $client->request('POST', '/qualifications/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Qualification'
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Qualification created successfully', $client->getResponse()->getContent());
    }

    public function testListQualifications()
    {
        $client = static::createClient();

        $client->request('GET', '/qualifications/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testEditQualification()
    {
        $client = static::createClient();

        // First, create a qualification to edit
        $client->request('POST', '/qualifications/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Qualification'
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $qualificationId = $responseContent['id']; // Assuming the response contains the qualification ID

        // Now, edit the qualification
        $client->request('POST', '/qualifications/edit/' . $qualificationId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Updated Qualification'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Qualification updated successfully', $client->getResponse()->getContent());
    }

    public function testDeleteQualification()
    {
        $client = static::createClient();

        // First, create a qualification to delete
        $client->request('POST', '/qualifications/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Qualification'
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $qualificationId = $responseContent['id']; // Assuming the response contains the qualification ID

        // Now, delete the qualification
        $client->request('DELETE', '/qualifications/delete/' . $qualificationId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Qualification deleted successfully', $client->getResponse()->getContent());
    }
}
