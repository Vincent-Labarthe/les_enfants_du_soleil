<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\EdsEntity;
use App\Entity\Location;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LocationFixtures extends BaseFixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Location::class, 10, function (Location $location) {
            $faker = Factory::create('fr_FR');
            $location->setType($faker->randomElement(['interne', 'externe']));
            $location->setIsCurrentLocation($faker->boolean);
            $location->setEds($faker->boolean ? $this->getReference(EdsEntity::class . '_' . random_int(1, 9)) : null);
            $location->setLocationStartedAt($faker->dateTimeBetween('-1 years', 'now'));
            $location->setPerson($this->getReference(Person::class . '_' . random_int(1, 9)));
            $location->setAddress($this->getReference(Address::class . '_' . random_int(1, 29)));
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
            AddressFixtures::class,
            EdsEntityFixtures::class
        ];
    }
}
