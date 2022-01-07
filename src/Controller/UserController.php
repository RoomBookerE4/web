<?php

namespace App\Controller;

use App\Form\UserForm;
use App\Domain\Auth\UserRoles;
use App\Domain\Auth\Entity\User;
use App\Domain\Auth\UserService;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create', name: 'create', methods: ['POST', 'GET'])]
    public function create(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserForm::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $this->userService->createUser($user);

            return $this->render('user/success.html.twig', [
                'controller_name' => "success"
            ]);
        }

        return $this->render('user/new.html.twig', [
            'controller_name' => "J'ai créé Albert", 
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(int $id): Response
    {
        $this->userService->deleteUser($id);

        return new Response();
    }
}
