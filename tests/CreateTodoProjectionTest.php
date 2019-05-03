<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateTodoProjectionTest extends WebTestCase
{
    public function testCreateTodo()
    {
        $client = static::createClient();

        $client->request('GET', '/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $kernel = static::$kernel;
        $application = new Application($kernel);
        $command = $application->find('event-store:projection:run');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'projection-name' => 'todo',
            '-o' => true,
        ]);

        $output = $commandTester->getDisplay();

        echo $output;
    }
}
