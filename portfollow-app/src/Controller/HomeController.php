<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Entity\User;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(PostRepository $postRepository, UserRepository $userRepository, Request $request): Response
    {
        $posts = $postRepository->findAll();

        
        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);
    }
    
}
