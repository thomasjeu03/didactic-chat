<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserList extends AbstractController
{
    #[Route('/user-list', name: 'user_list')]
    public function userList(UserRepository $userRepository): JsonResponse
    {
        /** @var $user ?User */
        $user = $this->getUser();

        return $this->json([
            'message' => 'users list :',
            'current user' => $user,
            'other users' => $userRepository->findAllExcept($this->getUser()),
            'all users' => $userRepository->findAll()
        ], 200, [], ['groups' => 'main']);
    }
}