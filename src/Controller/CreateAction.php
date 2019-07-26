<?php

declare(strict_types=1);

namespace App\Controller;

use App\Write\Command\CreateTodo;
use Prooph\EventStore\EventStore;
use Prooph\ServiceBus\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/create", name="create", methods={"POST"})
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

    public function __invoke(Request $request)
    {
        $command = CreateTodo::withDescription($request->request->get('description'));

        $this->bus->dispatch($command);

        return $this->redirectToRoute('list');
    }
}
