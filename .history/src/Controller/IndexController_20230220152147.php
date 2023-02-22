<?php
namespace App\Controller;

use Symfony\component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexController extends AbstractController
{
  
    #[Route('/', name: 'home')]
    public function Home( $name =' demmo name';)
    {
        return $this->render('index.html.twig',['name'=> $name]);
    }
}
