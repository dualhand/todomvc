<?php

declare(strict_types=1);

namespace App\Controller;

use App\Write\Command\CompleteTodo;
use App\Write\Command\IncompleteTodo;
use App\Write\Command\RemoveTodo;
use Prooph\EventStore\EventStore;
use Prooph\ServiceBus\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/incomplete", name="incomplete", methods={"GET"})
 */
class IncompleteAction extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $bus;

    /**
     * CreateAction constructor.
     * @param CommandBus $bus
     */
    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(Request $request)
    {
        $command = IncompleteTodo::withId($request->query->get('id'));

        $this->bus->dispatch($command);

        return $this->redirectToRoute('list');
    }
}
