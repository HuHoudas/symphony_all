<?php

namespace App\DataFixtures;

use App\Entity\CategoryManager;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const NAMEFILM = [
        'coucou',
        'non',
        'oui',
        'pwouette',
        'moia',
    ];
    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::NAMEFILM as $nameFilm) {
            $categoryName = CategoryFixtures::CATEGORIES[$i];
            $i++;
            $program = new Program();
            $program->setTitle($nameFilm);
            $program->setSynopsis($nameFilm);
            $program->setCategory($this->getReference('category_' . $categoryName));
            $manager->persist($program);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
