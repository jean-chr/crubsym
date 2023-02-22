<?php

namespace App\Controller;

use App\Entity\Article;
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
    public function Save( ): Response
    {
        $entitymanager = $this->getDoctrine()->getManager();

        $ar =new Article();

        return new Response('articles ajouter ');
        $entitymanager->flush();
    }
}
