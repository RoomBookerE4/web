<?php

namespace App\Controller;

use App\Domain\Auth\UserRoles;
use App\Domain\Auth\UserService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user', name: 'user_')] // Defines all the routes in this controller will be preceded by "/user".
class UserController extends AbstractController
{

    public function __construct(private UserService $userService)
    {
        
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {

        
        $this->userService->createUser("Albert", UserRoles::STUDENT, "password", "Duperrsi");

        return $this->render('user/index.html.twig', [
            'controller_name' => "J'ai créé Albert"
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(int $id): Response
    {
        $this->userService->deleteUser($id);

        return new Response();
    }
}
