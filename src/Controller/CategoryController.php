<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/new', name: 'app_category_new')]
    public function new(Request $request, CategoryRepository $categoryRepository)
    {
        // On construit le formulaire basé sur un type
        $form = $this->createForm(CategoryFormType::class);

        // On alimente le formulaire avec les données envoyées dans la requête
        $form->handleRequest($request);

        // On vérifie que le formualire est bien envoyé
        if($form->isSubmitted())
        {
            // On recupère les données du formulaire dans un variable
            $category = $form->getData();

            // On enregistre les données qui sont sous forme d'entité dans la base via le repository
            $categoryRepository->save($category, true);

            // On redirige vers la page des catégories
            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(int $id, CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $categoryRepository->find($id),
        ]);
    }


}
