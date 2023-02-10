<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name: 'app_product_')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'Liste des produits',
        ]);
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Product $product): Response
    {
        //dd($product->getName());
        return $this->render('product/details.html.twig', [
            'controller_name' => 'Liste des produits',
            'product'=> $product
        ]);
    }
}
