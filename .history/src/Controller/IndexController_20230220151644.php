<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexController extends AbstractController
{
  
    #[Route('/', name: 'home')]
    public function Home( $name = ''): Response
    {
        $name =' demmo name';
        return $this->render('index.html.twig',['name'=> $name]);
    }
}
