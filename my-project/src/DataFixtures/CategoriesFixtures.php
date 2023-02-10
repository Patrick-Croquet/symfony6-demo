<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter = 1;

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Informatique', null, $manager);

        // $parent = new Category();
        // $parent->setName('Informatique');
        // $parent->setSlug($this->slugger->slug($parent->getName())->lower());        
        // $manager->persist($parent);

        $this->createCategory('Ordinateurs portables', $parent, $manager);


        // $category = new Category();
        // $category->setName('Ordinateurs portables');
        // $category->setSlug($this->slugger->slug($category->getName())->lower());
        // $category->setParent($parent);
        // $manager->persist($category);

        $this->createCategory('Ecrans', $parent, $manager);

        $this->createCategory('Souris', $parent, $manager);

        // $parent = $this->createCategory('Mode', null, $manager);

        // $this->createCategory('Femme', $parent, $manager);
        // $this->createCategory('Homme', $parent, $manager);
        // $this->createCategory('Enfant', $parent, $manager);

        $manager->flush();
    }

    public function createCategory(string $name, Category $parent = null, ObjectManager $manager)
    {
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);        
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}
