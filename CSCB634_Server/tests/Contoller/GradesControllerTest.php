<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GradesControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddGrade()
    {
        $client = static::createClient();

        $client->request('POST', '/grades/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'grade' => 'A',
            'student_ids' => [1, 2, 3],
            'school_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Grade created successfully', $client->getResponse()->getContent());
    }

    public function testListGrades()
    {
        $client = static::createClient();

        $client->request('GET', '/grades/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetGrade()
    {
        $client = static::createClient();

        $client->request('GET', '/grades/getGrade/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testEditGrade()
    {
        $client = static::createClient();

        $client->request('POST', '/grades/edit/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'grade' => 'B',
            'student_ids' => [1, 2],
            'school_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Grade updated successfully', $client->getResponse()->getContent());
    }

    public function testDeleteGrade()
    {
        $client = static::createClient();

        $client->request('DELETE', '/grades/delete/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Grade deleted successfully', $client->getResponse()->getContent());
    }
}
