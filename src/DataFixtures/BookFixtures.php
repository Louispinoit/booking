<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use Faker\Factory;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $categories = $manager->getRepository(categorie::class)->findAll();

        for ($i = 0; $i < 100; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence(3));
            $book->setAuthor($faker->name);
            $randomCategory = $faker->randomElement($categories);
            $book->setIdCategorie($randomCategory);
            $book->setPublicateDate($faker->dateTimeBetween('-10 years', 'now'));
            $book->setDescription($faker->text(200));
            $book->setIsbn($faker->isbn13);

            $manager->persist($book);
        }

        $manager->flush();
    }
}
