<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ScheduleControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddSchedule()
    {
        $client = static::createClient();

        $client->request('POST', '/schedule/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'school_id' => 1,
            'student_id' => 1,
            'teacher_id' => 1,
            'monday' => ['Math'],
            'tuesday' => ['English'],
            'wednesday' => ['Science'],
            'thursday' => ['History'],
            'friday' => ['Art']
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Schedule created successfully', $client->getResponse()->getContent());
    }

    public function testListSchedules()
    {
        $client = static::createClient();

        $client->request('GET', '/schedule/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testEditSchedule()
    {
        $client = static::createClient();

        // First, create a schedule to edit
        $client->request('POST', '/schedule/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'school_id' => 1,
            'student_id' => 1,
            'teacher_id' => 1,
            'monday' => ['Math'],
            'tuesday' => ['English'],
            'wednesday' => ['Science'],
            'thursday' => ['History'],
            'friday' => ['Art']
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $scheduleId = $responseContent['id']; // Assuming the response contains the schedule ID

        // Now, edit the schedule
        $client->request('POST', '/schedule/edit/' . $scheduleId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'school_id' => 2,
            'student_id' => 2,
            'teacher_id' => 2,
            'monday' => ['Biology'],
            'tuesday' => ['Chemistry'],
            'wednesday' => ['Physics'],
            'thursday' => ['Geography'],
            'friday' => ['Music']
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Biology', $client->getResponse()->getContent());
    }

    public function testDeleteSchedule()
    {
        $client = static::createClient();

        // First, create a schedule to delete
        $client->request('POST', '/schedule/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'school_id' => 1,
            'student_id' => 1,
            'teacher_id' => 1,
            'monday' => ['Math'],
            'tuesday' => ['English'],
            'wednesday' => ['Science'],
            'thursday' => ['History'],
            'friday' => ['Art']
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $scheduleId = $responseContent['id']; // Assuming the response contains the schedule ID

        // Now, delete the schedule
        $client->request('DELETE', '/schedule/delete/' . $scheduleId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Schedule deleted', $client->getResponse()->getContent());
    }
}
