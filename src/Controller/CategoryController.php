<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Program;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/categories/", name="category_index")
 */
class CategoryController extends AbstractController
{
    
        public function index() : Response

     {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
            return $this->render(
                'category/index.html.twig',
                ['categories' => $categories]
            );
            
}



    /**
     * @Route("/{categoryName}", name="category_show")
     */

    public function show(string $CategoryName) : Response

    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' =>$categoryName]);

            if (!$category) {
                throw $this->createNotFoundException(
                    'No category with name : '.$categoryName.' found in category\'s table.'
                );
                }
        
                $programs = $this->getDoctrine()
                                 ->getRepository(Program::class)
                                 ->findBy([
                                     'category' => $category
                                 ], [
                                     'id' => 'DESC'
                                 ], 3);
        
            return $this->render('category/show.html.twig', [
                'category' => $category,
                'programs' => $programs

                ]);
                }
    

}