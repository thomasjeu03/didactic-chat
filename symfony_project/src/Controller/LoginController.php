<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\CookieHelper;
use App\Helper\JWTHelper;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(CookieHelper $cookieHelper, JWTHelper $JWTHelper): JsonResponse
    {
        /** @var $user ?User */
        $user = $this->getUser();

        if ($user) {
            return $this->json(
                [
                    'jwt' => $JWTHelper->createJWT($user),
                    'user' => $user
                ],
                200,
                ['set-cookie' => $cookieHelper->buildCookie($user)]
            );
        }

        return $this->json(
            [
                'message' => 'bad credentials',
                'user' => $user
            ], 401);
    }
}
