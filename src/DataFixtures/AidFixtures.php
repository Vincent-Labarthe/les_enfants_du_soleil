<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Aid;
use App\Entity\EdsEntity;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AidFixtures extends BaseFixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Aid::class, 10, function (Aid $aid) {
            $faker = Factory::create('fr_FR');
            $aid->setType(
                $faker->randomElement(
                    ['Logé', 'Alimentation', 'Instruction', 'Habillement', 'Soins', 'Suivi', 'Accueil en crèche', 'Equipement', 'Aide financière']
                )
            );
            $aid->setStartedAt($faker->dateTimeBetween('-1 years', 'now'));
            $aid->setEndedAt( $this->faker->boolean ? $faker->dateTime : null);
            $aid->setAnnualAmount($faker->randomFloat(4, 0, 100));
            $aid->setPerson($this->getReference(Person::class . '_' . random_int(1, 9)));

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