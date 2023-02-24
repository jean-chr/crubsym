<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategoryType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine ,private ValidatorInterface $validator) {}

    #[Route('/articles', name: 'articles_list', methods: ['GET'])]
    public function list( ManagerRegistry $doctrine) :Response
    { 
        $name ="toto SUPINFO";
        $ar =$doctrine->getRepository(Article::class)->findAll();   
        return $this->render('index/index.html.twig', [
            'name' => $name, 'articles'=>$ar
        ]);
    }

    #[Route('/articles/save',name:'articles_save', methods: ['GET','POST'])]
    public function save( ): Response
    {
        $entityManager = $this->doctrine->getManager();

        $ar =new Article();
        $ar->setTitre(" new title Article ");
        $ar->setPrix("1555");
        $ar->setDescription("Dscrip You can sharpen your MongoDB skills, engage with our diverse user base, and get answers to pressing questions");
        $ar->setContenu("MongoDB skills, questions");
        $ar->setImage("images/icon.jpg");
        $entityManager->persist($ar);
        $entityManager->flush();
        $this->addFlash('success','article added');
        return new Response('Saved new product with id '.$ar->getId());

    }

    
    #[Route('/articles/show/{id}',name:"articles_show", methods: ['GET'])]
    public function show($id): Response
    {
        $ar = $this->doctrine->getRepository(Article::class)->find($id);
        return $this->render('index/show.html.twig', [
            'article'=>$ar
        ]);
    }  
    
    #[Route('/articles/new',name:"articles_new", methods: ['GET','POST'])]
    public function new(Request $request) : Response
    {
        $ar = new Article();
       // $ar = $this->doctrine->findOneByIdJoinedToCategory();
        $form = $this->createForm(ArticleType::class,$ar);
        $errors = $this->validator->validate($ar);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ar= $form->getData();
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($ar);
            $entityManager->flush();
            $this->addFlash('success', 'Article ajouté !');
            return $this->redirectToRoute("articles_list");
        }
        return $this->render("index/new.html.twig",[
            "form"=>$form->createView(),
            "errors" => $errors,
            ]
        );
    }

    #[Route('/articles/update/{id}',name:"articles_update", methods: ['GET','PUT','POST'])]
    public function update(Request $request,$id) : Response
    {
        $ar = $this->doctrine->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class,$ar);
        $errors = $this->validator->validate($ar);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ar= $form->getData();
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($ar);
            $entityManager->flush();
            $this->addFlash('success', 'Article mise a jour avec success!');
            return $this->redirectToRoute("articles_list");
        }
        return $this->render("index/update.html.twig",[
            "form"=>$form->createView(),
            "errors" => $errors,
        ]);
    }

    #[Route('/articles/delete/{id}',name:"articles_delete", methods: ['GET','POST'])]
    public function delete($id): Response
    {
        $ar = $this->doctrine->getRepository(Article::class)->find($id);
        $entityManager = $this->doctrine->getManager();
        $entityManager->remove($ar);
        $entityManager->flush();
        $this->addFlash('success', 'Article deleted!');
        return $this->redirectToRoute("articles_list");
    }  

    #[Route('/category/new', name: 'category_new')]
    public function newCategory(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $errors = $this->validator->validate($category);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ar= $form->getData();
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Category :'.$category->getTitre().' ajouté avec success!');
            return $this->redirectToRoute("articles_list");
        }
        return $this->render("category/new.html.twig",[
            "form"=>$form->createView(),
            "errors" => $errors,
        ]);
    }
}
