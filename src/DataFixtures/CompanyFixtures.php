<?php

namespace App\DataFixtures;

use App\Entity\BehaviorEvent;
use App\Entity\Company;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends BaseFixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        try {
            $this->createMany(Company::class, 5, function (Company $company) {
                $faker = Factory::create('fr_FR');
                $company->setName($faker->company);
                $company->setCorrespondent($this->getReference(Person::class . '_' . random_int(1, 9)));
                $company->setAddress($this->getReference(Address::class . '_' . random_int(1, 29)));
                $company->setTel($faker->phoneNumber);
                $company->setComment($faker->text);
                $company->setType($faker->randomElement(['Banque', 'Industrie', 'Agricole', 'Autre']));
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
            AddressFixtures::class,
            PersonFixtures::class,
        ];
    }
}
