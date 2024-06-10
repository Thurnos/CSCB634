<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ParentsControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddParent()
    {
        $client = static::createClient();

        $client->request('POST', '/parents/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Parent',
            'email' => 'test@example.com',
            'number' => '1234567890'
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Parent created successfully', $client->getResponse()->getContent());
    }

    public function testListParents()
    {
        $client = static::createClient();

        $client->request('GET', '/parents/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetParent()
    {
        $client = static::createClient();

        $client->request('GET', '/parents/getParent/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testEditParent()
    {
        $client = static::createClient();

        $client->request('POST', '/parents/edit/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Updated Parent Name',
            'email' => 'updated@example.com',
            'number' => '9876543210'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Parent updated successfully', $client->getResponse()->getContent());
    }

    public function testDeleteParent()
    {
        $client = static::createClient();

        $client->request('DELETE', '/parents/delete/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Parent deleted successfully', $client->getResponse()->getContent());
    }

    public function testGetStudentsByParent()
    {
        $client = static::createClient();

        $client->request('GET', '/parents/1/students');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }
}
