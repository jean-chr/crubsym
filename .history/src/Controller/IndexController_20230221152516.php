<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    #[Route('/{home}', name: 'home')]
    public function Home( $name ="toto SUPINFO"): Response
    {
        $articles=['articles1','articles2','articles3','tomatos'];
        return $this->render('index/index.html.twig', [
            'name' => $name, 'articles'=>$articles
        ]);
    }
    #[Route('/articles/save', name: 'save')]
    public function Save( ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();;

        
        $ar =new Article();
        $ar->setTitre("Article");
        $ar->setPrix("1555");
        $ar->setContenu("You can sharpen your MongoDB skills, engage with our diverse user base, and get answers to pressing questions");

        $entityManager->persist($ar);
        $entityManager->flush();

        return new Response('Saved new product with id '.$ar->getId());

    }
}
