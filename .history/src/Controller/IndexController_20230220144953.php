<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
    /**
    * @Route("/")
    */
    public function Home()
    {
        return $this->render('Index.html.twig');
    }
}
