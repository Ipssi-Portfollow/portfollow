<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Images;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Repository\ImagesRepository;
use App\Form\PostRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/NewPost", name="NewPost")
     */
    public function New(UserRepository $userRepository,Request $request): Response
    {
        if($this->getUser() == null){
            return $this->render('error.html.twig', [
                'error' => "Vous n'aver pas les autorisations pour accédé a cette fonctionalité",
            ]);
        }

        $post = new Post();
        $form = $this->createForm(PostRegistrationType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //images
            $images = $form->get('images')->getData();
            foreach($images as $image) {
                $fichier = md5(uniqid()). '.' . $image->guessExtension() ;

                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                $img = new Images();
                $img->setPictName($fichier);
                $post->addImage($img);
            }

            $post->setUser($this->getUser());
            $post->setAddDate();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('userProfile', array(
                'id' => $this->getUser()->getId()
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
    public function ShowPost(PostRepository $postRepository, CommentRepository $commentRepository, int $id): Response
    {
        $post = $postRepository->findOneById($id);
        $comments = $commentRepository->findBy(array('post' =>  $post ) );
        $likers = $post->getUserLike();
        $allReadyLike = $likers->contains($this->getUser());

        
        $countLike = count($likers);

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'comments' => $comments,
            'liker' => $likers,
            'allReadyLike' => $allReadyLike,
            'countLike' => $countLike,
        ]);
    }

    /**
     * @Route("/EditPost/{id}", name="EditPost")
     */
    public function EditPost(PostRepository $postRepository,Request $request, int $id): Response
    {
        $post = $postRepository->findOneById($id);

        //vérification que le post appartiens bien a la persone qui cherche à le modifier
        if($post->getUser()->getId() != $this->getUser()->getId()){
            return $this->render('error.html.twig', [
                'error' => "Vous n'aver pas les autorisations pour accédé a cette fonctionalité",
            ]);
        }

        $form = $this->createForm(PostRegistrationType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //images
            $images = $form->get('images')->getData();
            foreach($images as $image) {
                $fichier = md5(uniqid()). '.' . $image->guessExtension() ;

                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                $img = new Images();
                $img->setPictName($fichier);
                $post->addImage($img);
            }

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
     * @Route("/deletImage/{id}", name="deletImage")
     */
    public function DeletImage(ImagesRepository $imagesRepository, int $id): Response
    {
        $images = $imagesRepository->findOneById($id);
        $post = $images->getPost();
        $user = $post->getUser();

        if( $this->getUser()->getId() == $user->getId() ){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($images);
            $entityManager->flush();

            return $this->redirectToRoute('ShowPost', array(
                'id' => $post->getId()
            ));
        }

        return $this->redirectToRoute('ShowPost', array(
            'id' => $post->getId()
        ));
    }

    /**
     * @Route("/deletPost/{id}", name="deletPost")
     */
    public function DeletPost(PostRepository $postRepository, int $id): Response
    {
        $post = $postRepository->findOneById($id);

        //vérification que le post appartiens bien a la persone qui cherche à le détruire
        if($post->getUser()->getId() != $this->getUser()->getId()){
            return $this->render('error.html.twig', [
                'error' => "Vous n'aver pas les autorisations pour accédé a cette fonctionalité",
            ]);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();

        return $this->redirectToRoute('userProfile', array(
            'id' => $this->getUser()->getId()
        ));
    }

    /**
     * @Route("/likePost/{id}", name="likePost", methods={"GET"})
     */
    public function likePost(PostRepository $postRepository,CommentRepository $commentRepository, int $id): Response
    {
        $user = $this->getUser();
        $post = $postRepository->findOneById($id);

        $entityManager = $this->getDoctrine()->getManager();
        $post->addUserLike($user);
        $entityManager->persist($post);
        $entityManager->flush();
        $comments = $commentRepository->findBy(array('post' =>  $post ) );

        return $this->redirectToRoute('ShowPost', array(
            'id' => $id
        ));
    }
    /**
     * @Route("/dislikePost/{id}", name="dislikePost", methods={"GET"})
     */
    public function dislikePost(PostRepository $postRepository,CommentRepository $commentRepository, int $id): Response
    {
        $user = $this->getUser();
        $post = $postRepository->findOneById($id);

        $entityManager = $this->getDoctrine()->getManager();
        $post->removeUserLike($user);
        $entityManager->persist($post);
        $entityManager->flush();
        $comments = $commentRepository->findBy(array('post' =>  $post ) );

        return $this->redirectToRoute('ShowPost', array(
            'id' => $id
        ));
    }
}
