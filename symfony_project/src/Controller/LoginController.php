<?php

namespace App\Controller;

use App\Entity\User;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

//    #[Route('/login', name: 'user_login')]
//    public function login(string $appSecret): JsonResponse
//    {
//        /** @var $user ?User */
//        $user = $this->getUser();
//
//        if (null === $user)
//        {
//            return $this->json([
//                'message' => 'missing_credentials',
//            ], Response::HTTP_UNAUTHORIZED);
//        }
//
//        $jwt = JWT::encode([
//            'username' => $user->getUsername(),
//            'id' => $user->getId()
//        ],
//            $appSecret,
//            'HS256');
//
//        return $this->json([
//            'jwt' => $jwt
//        ]);
//    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'user_login'
            && $request->isMethod('POST');
    }

    public function authentificate(Request $request): Passport
    {
        return new Passport(
            new UserBadge($request->request->get('username')),
            new PasswordCredentials($request->request->get('password'))
        );
    }
}
