<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $categories = [];
        for($i=0;$i<10;$i++)
        {
            $category = new Category();
            $category->setName('Catégorie ' . $i);

            $manager->persist($category);

            $categories[] = $category;
        }

        for($i=0;$i<500;$i++)
        {
            $category = $categories[rand(0,9)];

            $post = new Post();
            $post->setTitle('Article ' . $i);
            $post->setContent('Contenu de mon premier article');
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setCategory($category);

            $manager->persist($post);
        }
        
        $manager->flush();
    }
}
