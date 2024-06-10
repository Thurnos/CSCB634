<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AttendanceControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddAttendance()
    {
        $client = static::createClient();

        $client->request('POST', '/attendance/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'date' => '2024-06-10',
            'status' => 'present',
            'student_id' => 1,
            'subject_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Attendance record created successfully', $client->getResponse()->getContent());
    }

    public function testListAttendance()
    {
        $client = static::createClient();

        $client->request('GET', '/attendance/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetAttendance()
    {
        $client = static::createClient();

        $client->request('GET', '/attendance/getAttendance/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testEditAttendance()
    {
        $client = static::createClient();

        $client->request('POST', '/attendance/edit/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'date' => '2024-06-11',
            'status' => 'absent',
            'student_id' => 2,
            'subject_id' => 2
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Attendance record updated successfully', $client->getResponse()->getContent());
    }

    public function testDeleteAttendance()
    {
        $client = static::createClient();

        $client->request('DELETE', '/attendance/delete/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Attendance record deleted successfully', $client->getResponse()->getContent());
    }
}
