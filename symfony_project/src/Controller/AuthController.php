<?php

namespace App\Controller;

use App\Helper\CookieHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/auth', name: 'app_auth')]
    public function getCookie(CookieHelper $cookieHelper): JsonResponse
    {
        return $this->json(
            ['message' => "You're all set"],
            200,
            ['set-cookie' => $cookieHelper->buildCookie()]
        );
    }
}