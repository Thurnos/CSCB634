<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class StudentsControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddStudent()
    {
        $client = static::createClient();

        $client->request('POST', '/students/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'number' => '123456789',
            'parent_ids' => [1, 2],
            'school_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Student created successfully', $client->getResponse()->getContent());
    }

    public function testListStudents()
    {
        $client = static::createClient();

        // Ensure there is at least one student to list
        $client->request('POST', '/students/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'number' => '987654321',
            'parent_ids' => [3, 4],
            'school_id' => 1
        ]));

        // List students
        $client->request('GET', '/students/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('"name":"Jane Smith"', $client->getResponse()->getContent());
    }

    public function testEditStudent()
    {
        $client = static::createClient();

        // First, create a student to edit
        $client->request('POST', '/students/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'number' => '111111111',
            'parent_ids' => [5, 6],
            'school_id' => 2
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $studentId = $responseContent['id']; // Assuming the response contains the student ID

        // Now, edit the student
        $client->request('POST', '/students/edit/' . $studentId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Alice Thompson',
            'email' => 'alice.thompson@example.com',
            'number' => '222222222',
            'parent_ids' => [7, 8],
            'school_id' => 3
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Alice Thompson', $client->getResponse()->getContent());
    }

    public function testDeleteStudent()
    {
        $client = static::createClient();

        // First, create a student to delete
        $client->request('POST', '/students/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Bob Brown',
            'email' => 'bob.brown@example.com',
            'number' => '333333333',
            'parent_ids' => [9, 10],
            'school_id' => 1
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $studentId = $responseContent['id']; // Assuming the response contains the student ID

        // Now, delete the student
        $client->request('DELETE', '/students/delete/' . $studentId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Student deleted successfully', $client->getResponse()->getContent());
    }

    public function testGetStudentSchedule()
    {
        $client = static::createClient();

        // First, create a student with schedule
        $client->request('POST', '/students/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Eva Green',
            'email' => 'eva.green@example.com',
            'number' => '444444444',
            'parent_ids' => [11, 12],
            'school_id' => 1
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $studentId = $responseContent['id']; // Assuming the response contains the student ID

        // Now, fetch the student's schedule
        $client->request('GET', '/students/getSchedule/' . $studentId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}
