<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    #[Route('/hello/{title}', name: 'hello_world')]
    public function index(string $title): Response
    {
        return $this->render('hello_world/index.html.twig', [
            'controller_name' => $title
        ]);
    }
}
