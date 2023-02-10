<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductsFixtures extends Fixture
{
    public function __construct(
        private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\generator instance
        $faker = Faker\Factory::create('fr_FR');

        for($prod = 1; $prod <= 10; $prod++){
            $product = new Product();
            $product->setName($faker->text(15));
            $product->setDescription($faker->text());
            $product->setSlug($this->slugger->slug($product->getName())->lower());
            $product->setPrice($faker->numberBetween(900, 150000));
            $product->setStock($faker->numberBetween(0, 10));

            //On va chercher une référence de catégorie
            $category = $this->getReference('cat-'.rand(2,4));
            $product->setCategory($category);

            $this->setReference('prod-'.$prod, $product);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
