<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController
{
    #[Route('/chat/{topic}', name: 'chat_getMessage', methods: 'GET')]
    #[IsGranted('ROLE_USER')]
    public function getChatMessages(ChatRepository $chatRepository, PrivateTopicHelper $topicHelper, string $topic): JsonResponse
    {
        /** @var $user User */
        $user = $this->getUser();

        if (!$topicHelper->isUserInThisTopic($user->getId(), $topic)) {
            return $this->json([
                'status' => 0,
                'error' => "This user doesn't belong to this topic"
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->json([
            'chat' => $chatRepository->getAllMassagesOrderByDate($topic)
        ], 200, [], ['groups' => ['main']]);
    }

    public function persistMessage(Request $request, ChatRepository $chatRepository, EntityManagerInterface $entityManager, PrivateTopicHelper $topicHelper): JsonResponse
    {
        /** @var $user User */
        $user = $this->getUser();
        $chat = $chatRepository->findOneBy(['topic' => $request->request->get('topic')]);

        if (!$chat) {
            return $this->json([
                'status' => 0,
                'error' => "This user doesn't belong to this topic"
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!$topicHelper->isUserInThisTopic($user->getId(), $request->request->get('topic'))) {
            return $this->json([
                'status' => 0,
                'error' => "This user doesn't belong to this topic"
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $message = new Message();
        $message->setUser($user)
            ->setChat($chat)
            ->setDate(new \DateTime())
            ->setContent($request->request->get('content'));

        $entityManager->persist($message);
        $entityManager->flush();

        return $this->json([
            'status' => 1,
            'message' => "Message sent"
        ], Response::HTTP_CREATED);
    }
}