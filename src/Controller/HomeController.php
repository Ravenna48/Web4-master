<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProductRepository $product): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'HomeController',
            'products'=> $product->findAll(),
        ]);
    }
}
