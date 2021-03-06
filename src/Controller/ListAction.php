<?php

namespace App\Controller;

use App\Read\Query\TodoListQuery;
use Prooph\ServiceBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/", name="list")
 */
class ListAction extends AbstractController
{
    public function __invoke(QueryBus $bus)
    {
        $query = new TodoListQuery();
        $promise = $bus->dispatch($query);

        $result = null;
        $promise->then(function ($kk) use (&$result){
            $result = $kk;
        });

        return $this->render('index.html.twig', ['todos' => $result]);
    }
}
