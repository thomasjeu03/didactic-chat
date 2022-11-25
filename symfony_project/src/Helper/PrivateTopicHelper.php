<?php

namespace App\Helper;

class PrivateTopicHelper
{
    public function getPrivateChatTopic(int $userId1, int $userId2): string
    {
        if ($userId1 === $userId2) {
            throw new \InvalidArgumentException("Les deux ID ne peuvent pas etre identiques");
        }

        $order = [$userId1, $userId2];
        sort($order);

        return sprintf('%d.%d', $order[0], $order[1]);
    }

    public function getUsersFromChatTopic(string $chatTopic)
    {
        return explode('.', $chatTopic);
    }

    public function isUserInThisTTopic(int $userId, string $chatTopic): bool
    {
        return in_array($userId, $this->getUsersFromChatTopic($chatTopic));#
    }
}