<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/categorylist')]
    public function list(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/categorylist.html.twig', ['categories' =>$categories]);
    }

    #[Route('/category/edit/{id}', name: 'category_edit')]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire lié à l'entité existante
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Doctrine détecte les changements faits par le formulaire dans $category
            $entityManager->flush();

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/category.edit.html.twig', [
            'form' => $form,
        ]);
    }
}
