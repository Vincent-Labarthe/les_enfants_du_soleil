<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AddressFixtures extends BaseFixture implements FixtureGroupInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Address::class, 40, function (Address $address) {
            $faker = Factory::create('fr_FR');
            $address->setStreet($faker->streetName);
            $address->setZip($faker->postcode);
            $address->setCity($faker->city);
            $address->setCountry($faker->country);
        });
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}