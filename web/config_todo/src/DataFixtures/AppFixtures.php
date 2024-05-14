<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $articles = Array();

        for ($i = 0; $i < 10; $i++) {
            $articles[$i] = new Article();
            $articles[$i]->setTitre($faker->realText($maxNbChars = 50, $indexSize = 2));
            $doneBoolean = $faker->boolean;
            $articles[$i]->setDone($doneBoolean);

            $manager->persist($articles[$i]);
        }

        $manager->flush();
    }
}
