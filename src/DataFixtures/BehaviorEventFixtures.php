<?php

namespace App\DataFixtures;

use App\Entity\BehaviorEvent;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BehaviorEventFixtures extends BaseFixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(BehaviorEvent::class, 5, function (BehaviorEvent $behaviorEvent) {
            $faker = Factory::create('fr_FR');
            $behaviorEvent->setType($faker->randomElement(['fugue', 'réinsertion involontaire', 'autre']));
            $behaviorEvent->setComment($faker->text);
            $behaviorEvent->setPerson($this->getReference(Person::class . '_' . random_int(1, 9)));
        });
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group2'];
    }

    public function getDependencies()
    {
        return [
            PersonFixtures::class,
        ];
    }
}
