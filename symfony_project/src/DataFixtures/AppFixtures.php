<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use App\Factory\ChatFactory;
use App\Factory\MessagesFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(10);
        ChatFactory::createMany(10);
        MessagesFactory::createMany(10);
    }
}
