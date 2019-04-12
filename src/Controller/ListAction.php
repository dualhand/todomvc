<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="list")
 */
class ListAction extends AbstractController
{
    public function __invoke()
    {
        return $this->render('index.html.twig');
    }
}
