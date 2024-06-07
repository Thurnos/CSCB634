<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UsersControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddUser()
    {
        $client = static::createClient();

        $client->request('POST', '/addUser', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'testuser',
            'password' => 'testpassword',
            'role' => 1
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('User created successfully', $client->getResponse()->getContent());
    }

    public function testLogin()
    {
        $client = static::createClient();

        $client->request('POST', '/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'testuser',
            'password' => 'testpassword'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Login successful', $client->getResponse()->getContent());
    }

    public function testDeleteUser()
    {
        $client = static::createClient();

        // First, create a user to delete
        $client->request('POST', '/addUser', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'deleteuser',
            'password' => 'deletepassword',
            'role' => 1
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $userId = $responseContent['id']; // Assuming the response contains the user ID

        // Now, delete the user
        $client->request('DELETE', '/deleteUser/' . $userId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('User deleted successfully', $client->getResponse()->getContent());
    }
}