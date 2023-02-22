<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public $doctrine = new ManagerRegistry();
    public function __construct()
    {
         
        $entityManager = $doctrine->getManager();
    }

    #[Route('/articles', name: 'home')]
    public function Home( $name ="toto SUPINFO")
    {
        $articles=['articles1','articles2','articles3','tomatos'];
        return $this->render('index/index.html.twig', [
            'name' => $name, 'articles'=>$articles
        ]);
    }

    #[Route('/save', name: 'save')]
    public function Save( )
    {
        $entityManager = $doctrine->getManager();

        $ar =new Article();
        $ar->setTitre(" new title Article ");
        $ar->setPrix("1555");
        $ar->setDescription("Dscrip You can sharpen your MongoDB skills, engage with our diverse user base, and get answers to pressing questions");
        $ar->setContenu("MongoDB skills, questions");
        $ar->setImage("images/icon.jpg");
        $entityManager->persist($ar);
        $entityManager->flush();

        return new Response('Saved new product with id '.$ar->getId());

    }

    
    #[Route('/articles/{id}',name:"show")]
    public function show(Article $article)
    {
        
    }
}
