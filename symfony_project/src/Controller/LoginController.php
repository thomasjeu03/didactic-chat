<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\CookieHelper;
use App\Helper\JWTHelper;
use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(CookieHelper $cookieHelper, JWTHelper $JWTHelper, UserRepository $userRepository): JsonResponse
    {
        /** @var $user ?User */
        $user = $this->getUser();

        $jwt = $JWTHelper->createJWT($user);

        if ($user) {
            return $this->json(
                [
                    'jwt' => $jwt,
                    'valid jwt?' => $JWTHelper->isJwtValid($jwt),
                    'user' => $user,
                    'other users' => $userRepository->findAllCustom($user)
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

    #[Route('/logout', name: 'app_logout')]

    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
