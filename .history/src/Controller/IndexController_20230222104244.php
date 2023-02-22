<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IndexController extends AbstractController
{
    
    #[Route('/articles', name: 'home', methods: ['GET'],)]
    public function Home( ManagerRegistry $doctrine)
    { 
        $name ="toto SUPINFO";
        $ar =$doctrine->getRepository(Article::class)->findAll();   
        return $this->render('index/index.html.twig', [
            'name' => $name, 'articles'=>$ar
        ]);
    }

    #[Route('/articles/save',name:'urlsave', methods: ['GET','POST'])]
    public function Save( ManagerRegistry $doctrine)
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

    
    /* #[Route('/articles/{id}',name:"show")]
    public function show(Article $article)
    {
        
    }  */
    
    #[Route('/articles/new',name:"newarticle", methods: ['GET','POST'])]
    public function new(Request $request)
    {
        $ar = new Article();
        $form = $this->createFormBuilder($ar)
            ->add('titre', TextType::class)
            ->add('prix', TextType::class)
            ->add('contenu', TextType::class)
            ->add('save',SubmitType::class,array('label' => 'Creer' )
            )->getForm();

        $form ->handleRequest($request);

        if ($form->isSubmited() && $form->isValid()) {
            $ar= $form->getData();
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($ar);
            $entityManager->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render("index/new.html.twig",["form"=>$form->createView()]);
    }

}
