<?php

namespace App\Helper;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Cookie;

class CookieHelper
{
    private JWTHelper $JWTHelper;

    public function __construct(JWTHelper $JWTHelper)
    {
        $this->JWTHelper = $JWTHelper;
    }

    public function buildCookie(User $user): string
    {
        $jwt = $this->JWTHelper->createJWT($user);

        return Cookie::create(
            'mercureAuthorization',
            $jwt,
            new \DateTime("10 minutes"),
            '/.well-known/mercure',
            'localhost',
            true,
            true,
            false,
            Cookie::SAMESITE_STRICT
        );
    }
}