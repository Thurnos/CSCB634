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
    public function testGetUserRole()
    {
        $client = static::createClient();

        // First, create a user to fetch the role
        $client->request('POST', '/users/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'roleuser',
            'password' => 'rolepassword',
            'role' => 1
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $userId = $responseContent['id']; // Assuming the response contains the user ID

        // Fetch the user's role
        $client->request('GET', '/users/getRole/' . $userId);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('"role":1', $client->getResponse()->getContent());
    }

    public function testChangeUserRole()
    {
        $client = static::createClient();

        // First, create a user to change the role
        $client->request('POST', '/users/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'changeroleuser',
            'password' => 'changerolepassword',
            'role' => 1
        ]));

        $responseContent = json_decode($client->getResponse()->getContent(), true);
        $userId = $responseContent['id']; // Assuming the response contains the user ID

        // Change the user's role
        $client->request('POST', '/users/setRole/' . $userId, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'role' => 2
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('Role updated successfully', $client->getResponse()->getContent());
    }

    public function testListUsers()
    {
        $client = static::createClient();

        // Ensure there is at least one user to list
        $client->request('POST', '/users/add', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'listuser',
            'password' => 'listpassword',
            'role' => 1
        ]));

        // List users
        $client->request('GET', '/users/list');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertStringContainsString('"username":"listuser"', $client->getResponse()->getContent());
    }
}