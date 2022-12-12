<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\CookieHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class PingController extends AbstractController
{
    #[Route('/ping/{user}', name: 'ping_user', methods: 'POST')]
    public function pingUser(User $user, HubInterface $hub)
    {
        $update = new Update(
            [
                "http://127.0.0.1:1234/.well-known/mercure",
                "http://127.0.0.1:1234/.well-known/mercure/?topic=" . urlencode("http://127.0.0.1:1234/my-private-topic")
            ],
            json_encode([
                'user' => $user->getUsername(),
                'id' => $user->getId()
            ]),
            true
        );

        $hub->publish($update);

        return $this->json([
            'message' => 'Ping sent'
        ]);
    }
}