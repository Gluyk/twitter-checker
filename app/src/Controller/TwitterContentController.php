<?php

namespace App\Controller;

use App\Entity\TwitterContent;
use App\Form\TwitterContentType;
use App\Repository\TwitterContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/twitter/content")
 */
class TwitterContentController extends AbstractController
{
    /**
     * @Route("/", name="twitter_content_index", methods={"GET"})
     */
    public function index(TwitterContentRepository $twitterContentRepository): Response
    {
        return $this->render('twitter_content/index.html.twig', [
            'twitter_contents' => $twitterContentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="twitter_content_show", methods={"GET"})
     */
    public function show(TwitterContent $twitterContent): Response
    {
        return $this->render('twitter_content/show.html.twig', [
            'twitter_content' => $twitterContent,
        ]);
    }
}
