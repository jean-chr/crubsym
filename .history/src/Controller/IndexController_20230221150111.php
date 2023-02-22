<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $articles=['articles1','articles2','articles3','tomatos'];
        return $this->render('index/index.html.twig', [
            'name' => $name, 'articles'=>$articles
        ]);
    }
}
