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
    public fonction home()
    {
        return new JsonResponse('<h1>okl dommee</h1>')
    }
}
