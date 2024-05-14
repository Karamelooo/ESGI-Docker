<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $task = ['task1', 'task2', 'task3', 'task4', 'task5', 'task6', 'task7', 'task8', 'task9', 'task10'];
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitre($task[$i]);
            $article->setDone($i % 2 === 0); // Alternating done status for variety

            $manager->persist($article);
        }

        $manager->flush();
    }
}
