<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentsRepository;
use App\Entity\Article;
use App\Entity\Users;
use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class CRUDArticlesController extends AbstractController
{
    /**
     * @Route("/myarticles/{id}", name="myarticles")
     */
    public function index($id,UsersRepository $repoUsers, ArticleRepository $repoArticle, EntityManagerInterface $manager): Response
    {
        $articles = $repoArticle->findByPoster($id);

        return $this->render('crud_articles/index.html.twig', [
          'articles' => $articles,
        ]);
    }

    /**
     * @Route("/delarticle/{id}", name="delarticle")
     */
    public function delarticle($id,CommentsRepository $repoComments, ArticleRepository $repoArticle,CategoriesRepository $repoCat,EntityManagerInterface $manager): Response
    {
      $article = $repoArticle->find($id);
      $comments = $repoComments->findByReferencedArticle($id);
      $articles = $repoArticle->findByPoster(1);

      if($article != null ){
        for ($i=0; $i < sizeof($comments); $i++) {
          $manager->remove($comments[$i]);
        }
        $manager->flush();
        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute('myarticles', ['id' => 1]);

      }else{
        return $this->redirectToRoute('myarticles', ['id' => 1]);
      }
    }

    /**
     * @Route("/addcomment/{id}", name="addcomment")
     */
    public function editarticle(Users $user, CategoriesRepository $repoCat, UsersRepository $repoUsers, Request $request, ArticleRepository $repoArticle, EntityManagerInterface $manager, CommentsRepository $repoComments): Response
    {
 
      $article = $repoArticle->find($user);
      $comments = $repoComments->findByReferencedArticle($user);
      

      return $this->render('blog/article.html.twig', [
        'article' => $article,
        'comments' => $comments,
      ]);

    }

    /**
     * @Route("/createarticle/{id}", name="createarticle")
     */
    public function createarticle(Users $user, CategoriesRepository $repoCat, UsersRepository $repoUsers, Request $request, ArticleRepository $repoArticle, EntityManagerInterface $manager): Response
    {
        $categories = $repoCat->findAll();
        $article = new Article();
        $form = $this->createFormBuilder( $article )
                ->add('aTitle', TextType::class, [
                  'attr' =>[
                    'placeholder' =>"Titre de l'article",

                  ]
                ])
                ->add('aContent', TextareaType::class, [
                  'attr' =>[
                    'placeholder' =>"Contenu de l'article (en html)"
                  ]
                ])
                ->add('aPic', TextType::class ,[
                  'attr' =>[
                    'placeholder' =>"url de l'image"
                  ]
                ])
                ->getForm();

    $form->handleRequest($request);
    if( $form->isSubmitted() ){
          $article->setADate(new \DateTime());
          $article->setAPoster($user);

          $catName = $request->request->get('cat');
          $cat = $repoCat->findOneByTitle($catName);
          if( $cat != null){
            $article->setACategory($cat);
          }else{
            $cat = new Categories();
            $cat->setCTitle($catName);
            $manager->persist($cat);
            $manager->flush();
            $article->setACategory($cat);

          }
          $manager->persist($article);
          $manager->flush();
          return $this->redirectToRoute('article', ['id' => $article->getAId()]);
          }


        return $this->render('crud_articles/createarticle.html.twig', [
          'formArticle' => $form->createView(),
          'categories' => $categories,
        ]);
    }
}
