<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PrincipalsControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddPrincipal()
    {
        $client = static::createClient();

        $client->request('POST', '/principals/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Test Principal',
            'email' => 'principal@example.com',
            'school_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Principal created successfully', $client->getResponse()->getContent());
    }

    public function testListPrincipals()
    {
        $client = static::createClient();

        $client->request('GET', '/principals/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetPrincipal()
    {
        $client = static::createClient();

        $client->request('GET', '/principals/getPrincipal/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testEditPrincipal()
    {
        $client = static::createClient();

        $client->request('POST', '/principals/edit/1', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'name' => 'Updated Principal Name',
            'email' => 'updated_principal@example.com',
            'school_id' => 1
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Principal updated successfully', $client->getResponse()->getContent());
    }

    public function testDeletePrincipal()
    {
        $client = static::createClient();

        $client->request('DELETE', '/principals/delete/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Principal deleted successfully', $client->getResponse()->getContent());
    }

    public function testGetStudentsByPrincipal()
    {
        $client = static::createClient();

        $client->request('GET', '/principals/getStudents/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetSubjectsByPrincipal()
    {
        $client = static::createClient();

        $client->request('GET', '/principals/getSubjects/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetTeachersByPrincipal()
    {
        $client = static::createClient();

        $client->request('GET', '/principals/getTeachers/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }

    public function testGetParentsByPrincipal()
    {
        $client = static::createClient();

        $client->request('GET', '/principals/getParents/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        // Add more assertions as needed to validate the response content
    }
}
