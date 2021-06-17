<?php

namespace App\Controller;

use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Form\CommentRegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/NewComment/{id}", name="NewComment" , methods={"POST"})
     */
    public function New(PostRepository $postRepository,Request $request,int $id): Response
    {
        if($this->getUser() == null){
            return $this->render('error.html.twig', [
                'error' => "Vous n'aver pas les autorisations pour accédé a cette fonctionalité",
            ]);
        }

        $comment = new Comment();

        if($postRepository->findOneById($id) != null && $this->getUser() != null && $request->get('critique') != ''  ){
            
            $comment->setAddDate();
            $comment->setText($request->get('critique'));
            $comment->setUser($this->getUser());
            $comment->setPost($postRepository->findOneById($id));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('ShowPost', array(
                'id' => $id,
            ));

        }else{
            
            return $this->render('error.html.twig', [
                'error' => "Problème lors de l'envoie du commentaire",
            ]);
        }
    }

    /**
     * @Route("/EditComment/{id}", name="EditComment" , methods={"POST","GET"})
     */
    public function edit(CommentRepository $commentRepository,PostRepository $postRepository,Request $request,int $id): Response
    {

        $comment = $commentRepository->findOneById($id );

        if( ($comment == null || $this->getUser() == null) || ( $comment->getUser() != $this->getUser() ) ){
            return $this->render('error.html.twig', [
                'error' => "Vous n'aver pas les autorisations pour accédé a cette fonctionalité",
            ]);
        }

        $form = $this->createForm(CommentRegistrationType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            $postId = $comment->getPost()->getId();

            return $this->redirectToRoute('ShowPost', array(
                'id' => $postId,
            ));

        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }
}
