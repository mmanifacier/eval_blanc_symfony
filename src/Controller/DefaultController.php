<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $articleRepository;

    /**
     * Class constructor.
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/", name="default")
     */
    public function home(): Response
    {
        $articles = $this->articleRepository->findAll();
        return $this->render('default/index.html.twig', [
            'articles' => $articles,
        ]);
    }

        /**
     * @Route("/article/{article}", name="detail")
     */
    public function detail(Article $article): Response
    {
        return $this->render('default/detail.html.twig', [
            'article' => $article,
        ]);
    }
}
