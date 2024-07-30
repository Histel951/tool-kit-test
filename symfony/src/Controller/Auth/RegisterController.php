<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Form\RegisterFormType;
use App\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    public function __construct(private readonly UserServiceInterface $userService) {}

    #[Route(path: '/register', name: 'register')]
    public function register(
        Request $request,
    ): JsonResponse
    {
        $user = new User();
        $form = $this->createForm(RegisterFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $this->userService->processRegistration($user);
        }

        return $this->json($user);
    }
}
