<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/", name="category_index")
     */

     public function index() : Response

     {
        $programs = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
            return $this->render(
                'category/index.html.twig',
                ['category' => $category]
            );
            
}
}