<?php

namespace App\Controller;

use App\Entity\User;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'user_login')]
    public function login(string $appSecret): JsonResponse
    {
        /** @var $user ?User */
        $user = $this->getUser();

        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $jwt = JWT::encode([
            'username' => $user->getUsername(),
            'id' => $user->getId()
        ], $appSecret, 'HS256');

        return $this->json([
            'jwt' => $jwt
        ]);
    }
}
