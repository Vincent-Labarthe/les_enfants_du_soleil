<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\EdsEntity;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EdsEntityFixtures extends BaseFixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(EdsEntity::class, 10, function (EdsEntity $edsEntity) {
            $faker = Factory::create('fr_FR');
            $edsEntity->setName($faker->city);
            $edsEntity->setType(
                $faker->randomElement(['Dg', 'Site', 'Village', 'foyer CAE', 'foyer enfant', 'foyer ados', 'foyer jeune', 'CAT', 'Cantine'])
            );
            $edsEntity->addManager($this->getReference(Person::class . '_' . random_int(1, 9)));
            $edsEntity->setAddress($this->getReference(Address::class . '_' . random_int(1, 29)));
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
        ];
    }
}
