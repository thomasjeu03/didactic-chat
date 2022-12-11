<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\CookieHelper;
use App\Helper\JWTHelper;
use App\Repository\ChatRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserListController extends AbstractController
{
    #[Route('/user-list', name: 'user_list')]
    public function userList(UserRepository $userRepository): JsonResponse
    {
        return $this->json([
            'user' => $userRepository->findAllCustom()
        ], 200, [], ['groups' => 'main']);
    }
}