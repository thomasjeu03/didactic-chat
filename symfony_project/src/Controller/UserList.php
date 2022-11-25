<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserList extends AbstractController
{
    #[Route('/user-list', name: 'user_list', methods: 'GET')]
    public function userList(UserRepository $userRepository): JsonResponse
    {
        return $this->json([
            'users' => $userRepository->findAllExcept($this->getUser())
        ], 200, [], ['groups' => 'main']);
    }
}