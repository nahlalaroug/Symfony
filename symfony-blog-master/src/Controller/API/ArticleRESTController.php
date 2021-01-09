<?php

namespace App\Controller\API;

use App\Repository\UsersRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleRESTController extends AbstractController
{
       /**
     * @Route("/api/getarticles", name="apigetarticles", methods={"GET"})
     */
    public function index(ArticleRepository $repoArticle, EntityManagerInterface $manager, NormalizerInterface $normalizer): Response    
    {
        $articles = $repoArticle->findAll();
        dump($articles);

        $articlesNorm = $normalizer->normalize($articles);
        $json = json_encode($articlesNorm);
   
        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }

}
