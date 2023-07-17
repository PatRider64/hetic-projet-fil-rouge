<?php

namespace App\DataFixtures;

use App\Factory\UserSiteFactory;
use App\Factory\CourseFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserSiteFactory::createMany(30);
        CourseFactory::createMany(10);
    }
}
