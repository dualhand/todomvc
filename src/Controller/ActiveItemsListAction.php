<?php

namespace App\Controller;

use App\Read\Query\ActiveTodosListQuery;
use App\Read\Query\TodoListQuery;
use Prooph\ServiceBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/active", name="active_items_list")
 */
class ActiveItemsListAction extends AbstractController
{
    public function __invoke(QueryBus $bus)
    {
        $query = new ActiveTodosListQuery();
        $promise = $bus->dispatch($query);

        $result = null;
        $promise->then(function ($activeTodos) use (&$result){
            $result = $activeTodos;
        });

        return $this->render('index.html.twig', ['todos' => $result]);
    }
}
