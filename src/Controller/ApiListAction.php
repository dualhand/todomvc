<?php

namespace App\Controller;

use App\Read\Query\TodoListQuery;
use Prooph\ServiceBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/list", name="api_list")
 */
class ApiListAction extends AbstractController
{
    public function __invoke(QueryBus $bus)
    {
        $query = new TodoListQuery();
        $promise = $bus->dispatch($query);

        $result = null;
        $promise->then(function ($kk) use (&$result){
            $result = $kk;
        });

        return new Response();
    }
}
