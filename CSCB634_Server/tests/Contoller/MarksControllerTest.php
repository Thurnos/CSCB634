<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MarksControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddMark()
    {
        $client = static::createClient();

        $client->request('POST', '/marks/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'mark' => 85,
            'date' => '2024-06-15',
            'student_id' => 1,
            'subject_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Mark created successfully', $client->getResponse()->getContent());
    }

    public function testListMarks()
    {
        $client = static::createClient();

        $client->request('GET', '/marks/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetMark()
    {
        $client = static::createClient();

        $client->request('GET', '/marks/getMark/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testEditMark()
    {
        $client = static::createClient();

        $client->request('POST', '/marks/edit/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'mark' => 90,
            'date' => '2024-06-20',
            'student_id' => 1,
            'subject_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Mark updated successfully', $client->getResponse()->getContent());
    }

    public function testDeleteMark()
    {
        $client = static::createClient();

        $client->request('DELETE', '/marks/delete/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Mark deleted successfully', $client->getResponse()->getContent());
    }
}
