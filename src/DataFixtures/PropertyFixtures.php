<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=0; $i<100; $i++){

             $property = new Property();
             $property
                ->setTitle($faker->words(3,true))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(20,350))
                ->setRooms($faker->numberBetween(1,10))
                ->setBedRooms($faker->numberBetween(2,10))
                ->setFloor($faker->numberBetween(0,10))
                ->setPrice($faker->numberBetween(100,10000))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
                ->setCity($faker->city)
                ->setAdresse($faker->address)
                ->setPostalCode($faker->postcode)
                ->setSold(false)
                ->setCreatedAt(new \DateTime());

             $manager->persist($property);
            
        }
        $manager->flush();

    }
}
