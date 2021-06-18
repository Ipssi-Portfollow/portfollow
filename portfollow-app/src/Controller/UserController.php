<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/recherche/{data}", name="user_recherche", methods={"GET"})
     */
    public function recherche(UserRepository $userRepository,Request $request,$data): Response
    {
        $users = $userRepository->findAllData($data);
        return $this->render('user/recherche.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/{id}", name="userProfile", methods={"GET"})
     */
    public function userProfile(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->findOneById($id);
        $posts = $user->getPosts();
        if($user != null){
            return $this->render('user/userProfile.html.twig', [
                'user' => $user,
                'posts' => $posts,
            ]);
        }else{
            return $this->render('error.html.twig', [
                'error' => "le compte n'as pas été trouvé",
            ]);
        }
        
    }

    /**
     * @Route("/new", name="user_registration", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */

    public function new(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
      //  $user->setPassword('1234');
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->setPassword($encoder->encodePassword($user,$user->getPassword()));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
