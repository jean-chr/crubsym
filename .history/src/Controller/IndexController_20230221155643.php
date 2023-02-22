<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    #[Route('/article', name: 'home')]
    public function Home( $name ="toto SUPINFO")
    {
        $articles=['articles1','articles2','articles3','tomatos'];
        return $this->render('index/index.html.twig', [
            'name' => $name, 'articles'=>$articles
        ]);
    }
    
    #[Route('/articles/save', name: 'save')]
    public function Save( ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();;

        //for(i=1 ; i<10;i++)
        $ar =new Article();
        $ar->setTitre("Article");
        $ar->setPrix("1555");
        $ar->setContenu("You can sharpen your MongoDB skills, engage with our diverse user base, and get answers to pressing questions");

        $entityManager->persist($ar);
        $entityManager->flush();

        return new Response('Saved new product with id '.$ar->getId());

    }

    
    #[Route('/product/{id}')]
    public function show(Article $article)
    {
        // use the Product!
        // ...
    }
}
