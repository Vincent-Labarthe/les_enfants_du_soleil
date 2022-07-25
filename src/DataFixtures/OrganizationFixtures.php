<?php

namespace App\DataFixtures;

use App\Entity\TrainingInstitution;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrganizationFixtures extends BaseFixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        try {
            $this->createMany(TrainingInstitution::class, 5, function (TrainingInstitution $organization) {
                $faker = Factory::create('fr_FR');
                $organization->setName($faker->company);
                $organization->setType($faker->randomElement(['Ecole maternelle', 'Ecole primaire', 'Ecole secondaire', 'Ecole supérieure', 'Autre']));
                $organization->setCorrespondent($this->getReference(Person::class . '_' . random_int(1, 9)));
                $organization->setAddress($this->getReference(Address::class . '_' . random_int(1, 29)));
                $organization->setTel($faker->phoneNumber);
                $organization->setComment($faker->text);
            });
        }catch (\Exception $e) {
            echo $e->getMessage();
        }

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
        ];
    }
}
