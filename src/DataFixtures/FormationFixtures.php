<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use App\Entity\TrainingInstitution;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FormationFixtures  extends BaseFixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Formation::class, 5, function (Formation $formation) {
            $faker = Factory::create('fr_FR');
            $formation->setClass($faker->randomElement(['6e', '5e', '4e', '3e', '2nde', '1ère', 'Terminale','Bac+1', 'Bac+2']));
            $formation->setOrganization($this->getReference(TrainingInstitution::class . '_' . random_int(1, 5)));
            $formation->setPerson($this->getReference(Person::class . '_' . random_int(1, 9)));
            $formation->setLevel($faker->randomElement(['BEPC', 'BEP', 'BAC', 'BAC+2', 'BAC+3', 'BAC+4', 'BAC+5', 'BAC+6']));
            $formation->setResult($faker->text);
            $formation->setSpecialty($faker->randomElement(['Informatique', 'Mécanique', 'Electronique', 'Autre']));
            $formation->setStartedAt($faker->dateTimeBetween('-1 years', 'now'));
            $formation->setSuggestedDirection($faker->text);
        });
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group3'];
    }

    public function getDependencies()
    {
        return [
            PersonFixtures::class,
            AddressFixtures::class,
            OrganizationFixtures::class,
        ];
    }
}
