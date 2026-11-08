<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/category.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/{id}')]
    public function show(Category $category): Response
    {
        return $this->render('category/category.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category,
        ]);
    }
}
