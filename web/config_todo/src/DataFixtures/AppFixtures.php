<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitre('Titre ' . $i);
            $article->setDone($i % 2 === 0); // Alternating done status for variety

            $manager->persist($article);
        }

        $manager->flush();
    }
}
