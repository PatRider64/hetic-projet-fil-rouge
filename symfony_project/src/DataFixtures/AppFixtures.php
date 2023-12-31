<?php

namespace App\DataFixtures;

use App\Factory\UserSiteFactory;
use App\Factory\CourseFactory;
use App\Factory\MasterclassFactory;
use App\Factory\CompositorFactory;
use App\Factory\MusicSheetFactory;
use App\Factory\QuizFactory;
use App\Factory\QuestionFactory;
use App\Factory\ChatFactory;
use App\Factory\MessageFactory;
use App\Factory\MasterclassVideoFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserSiteFactory::createMany(30);
        CourseFactory::createMany(10);
        CompositorFactory::createMany(20);
        MusicSheetFactory::createMany(25);
        MasterclassVideoFactory::createMany(10);
        MasterclassFactory::createMany(10);
        QuizFactory::createMany(10);
        QuestionFactory::createMany(40);
        ChatFactory::createMany(10);
        MessageFactory::createMany(40);
    }
}
