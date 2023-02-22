<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
  
    #[Route('/', name: 'home')]
    public function Home( $name = '')
    {
        $name =' demmo name';
        return $this->render('index.html.twig',['name'=> $name]);
    }
}
