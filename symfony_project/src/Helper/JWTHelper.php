<?php

namespace App\Helper;

use App\Entity\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHelper
{
    private string $mercureSecret;

    public function __construct(string $mercureSecret)
    {
        $this->mercureSecret = $mercureSecret;
    }

    public function createJWT(User $user): string
    {
        $payload = ["mercure" => [
            "subscribe" => ["https://example.com/user/{$user->getId()}/{?topic}"],
            "payload" => [
                "username" => $user->getUsername(),
                "userid" => $user->getId()
            ]
        ]];

        return JWT::encode($payload, $this->mercureSecret, 'HS256');
    }
}