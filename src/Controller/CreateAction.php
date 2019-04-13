<?php

declare(strict_types=1);

namespace App\Controller;

use App\Write\Command\CreateTodo;
use Prooph\EventStore\EventStore;
use Prooph\ServiceBus\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route(path="/create", name="create")
 */
class CreateAction extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $bus;
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * CreateAction constructor.
     * @param CommandBus $bus
     * @param EventStore $eventStore
     */
    public function __construct(CommandBus $bus, EventStore $eventStore)
    {
        $this->bus = $bus;
        $this->eventStore = $eventStore;
    }

    public function __invoke()
    {
        $command = CreateTodo::withDescription('New todo dualhand!');

        $this->bus->dispatch($command);

        return $this->render('index.html.twig');
    }
}
