<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Form\PostRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("/NewPost", name="NewPost")
     */
    public function New(UserRepository $userRepository,Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostRegistrationType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //à remplacer par le réel user
            $post->setUser($userRepository->findOneById(1));
            //à remplacer par le réel user
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('userProfile', array(
                'id' => 1 //à remplacer par le réel user
            ));
        }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ShowPost/{id}", name="ShowPost" , methods={"GET"})
     */
    public function ShowPost(PostRepository $postRepository, int $id): Response
    {
        $post = $postRepository->findOneById($id);
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/EditPost/{id}", name="EditPost")
     */
    public function EditPost(PostRepository $postRepository,Request $request, int $id): Response
    {
        $post = $postRepository->findOneById($id);
        $form = $this->createForm(PostRegistrationType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('ShowPost', array(
                'id' => $post->getId()
            ));
        }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deletPost/{id}", name="deletPost")
     */
    public function DeletPost(PostRepository $postRepository, int $id): Response
    {
        $post = $postRepository->findOneById($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();

        return $this->redirectToRoute('userProfile', array(
            'id' => 1 //à remplacer par le réel Id user
        ));
    }
}
