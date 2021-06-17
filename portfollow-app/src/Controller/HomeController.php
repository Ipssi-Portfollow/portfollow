<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $postRepository, UserRepository $userRepository): Response
    {
        $posts = $postRepository->findBy(array(), array('addDate' => 'DESC'));
        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
