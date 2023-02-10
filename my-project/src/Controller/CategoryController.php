<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie', name: 'app_category_')]
class CategoryController extends AbstractController
{
    #[Route('/{slug}', name: 'list')]
    public function list(Category $category): Response
    {
        // dd($product->getName());
        // On liste les produits de la catégorie
        $products = $category->getProducts();

        return $this->render('category/list.html.twig', [
            'controller_name' => 'Liste des produits',
            'category'=> $category,
            'products'=> $products
        ]);
    }
}
