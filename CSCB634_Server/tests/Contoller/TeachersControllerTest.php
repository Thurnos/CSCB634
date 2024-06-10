<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TeachersControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddTeacher()
    {
        $client = static::createClient();

        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Teacher created successfully', $client->getResponse()->getContent());
    }

    public function testGetTeacher()
    {
        $client = static::createClient();

        // First, create a teacher to get
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $teacherId = $responseContent['id']; // Assuming the response contains the teacher ID

        // Now, get the teacher
        $client->request('GET', '/teachers/getTeacher/' . $teacherId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Jane Doe', $client->getResponse()->getContent());
    }

    public function testEditTeacher()
    {
        $client = static::createClient();

        // First, create a teacher to edit
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Edit Doe',
            'email' => 'edit.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $teacherId = $responseContent['id']; // Assuming the response contains the teacher ID

        // Now, edit the teacher
        $client->request('POST', '/teachers/edit/' . $teacherId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Edited Name',
            'email' => 'edited.name@example.com'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Teacher updated successfully', $client->getResponse()->getContent());
    }

    public function testDeleteTeacher()
    {
        $client = static::createClient();

        // First, create a teacher to delete
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Delete Doe',
            'email' => 'delete.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $teacherId = $responseContent['id']; // Assuming the response contains the teacher ID

        // Now, delete the teacher
        $client->request('DELETE', '/teachers/delete/' . $teacherId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Teacher deleted successfully', $client->getResponse()->getContent());
    }

    public function testListTeachers()
    {
        $client = static::createClient();

        // Ensure there is at least one teacher to list
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'List Doe',
            'email' => 'list.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        // List teachers
        $client->request('GET', '/teachers/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('"name":"List Doe"', $client->getResponse()->getContent());
    }

    public function testGetStudents()
    {
        $client = static::createClient();

        // Ensure there is a teacher with students
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Student Doe',
            'email' => 'student.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $teacherId = $responseContent['id']; // Assuming the response contains the teacher ID

        // Get students of the teacher
        $client->request('GET', '/teachers/getStudents/' . $teacherId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetSchedule()
    {
        $client = static::createClient();

        // Ensure there is a teacher with a schedule
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Schedule Doe',
            'email' => 'schedule.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $teacherId = $responseContent['id']; // Assuming the response contains the teacher ID

        // Get schedule of the teacher
        $client->request('GET', '/teachers/getSchedule/' . $teacherId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetSubjects()
    {
        $client = static::createClient();

        // Ensure there is a teacher with subjects
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Subject Doe',
            'email' => 'subject.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $teacherId = $responseContent['id']; // Assuming the response contains the teacher ID

        // Get subjects of the teacher
        $client->request('GET', '/teachers/getSubjects/' . $teacherId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetQualifications()
    {
        $client = static::createClient();

        // Ensure there is a teacher with qualifications
        $client->request('POST', '/teachers/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Qualification Doe',
            'email' => 'qualification.doe@example.com',
            'qualification_ids' => [1, 2],
            'school_id' => 1,
            'grade_ids' => [1, 2],
            'subject_ids' => [1, 2]
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $teacherId = $responseContent['id']; // Assuming the response contains the teacher ID

        // Get qualifications of the teacher
        $client->request('GET', '/teachers/getQualifications/' . $teacherId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}
