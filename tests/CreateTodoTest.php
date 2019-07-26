<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateTodoTest extends WebTestCase
{
    public function testCreateTodo()
    {
        $client = static::createClient();

        $client->request('POST', '/create', ['description' => 'santi es el puto amo!']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
