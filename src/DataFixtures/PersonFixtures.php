<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixtures extends BaseFixture implements FixtureGroupInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Person::class, 50, function (Person $person) {
            $faker = Factory::create('fr_FR');
            $person->setFirstName($faker->firstName);
            $person->setLastName($faker->lastName);
            $person->setEmail($faker->email);
            $person->setTel($faker->phoneNumber);
            $person->setDateOfBirth($faker->dateTimeBetween('-18 years', '-1 years'));
            $person->setSupportStartedAt($faker->dateTimeBetween('-2 years'));
            $person->setSexe($faker->randomElement(['M', 'F']));
            $person->setImageUrl($faker->imageUrl(200, 200));
            $person->setFamilyRelation($faker->randomElement(['Mère', 'Père', 'Frère', 'Soeur', 'Cousin', 'Autre']));
            $person->setOrigin(
                $faker->randomElement(
                    [
                        'enfant déshérité',
                        'femmes déshéritée',
                        'enfant de femme déshéritée',
                        'salarié',
                        'enfant de salarié',
                        'prestataire'
                    ]
                )
            );
        });
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group2'];
    }
}
