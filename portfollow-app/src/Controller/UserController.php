<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Abonnement;
use App\Form\UserRegistrationType;
use App\Repository\UserRepository;
use App\Repository\PostRepository;
use App\Repository\AbonnementRepository;
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
     * @Route("/errortest", name="errortest", methods={"GET"})
     */
    public function errortest(): Response
    {
        return $this->render('error.html.twig', [
            'error' => "le compte n'as pas été trouvé",
        ]);
    
    }

     /**
     * @Route("/abonnement/{id}", name="abonnement", methods={"GET"})
     */
    public function abonnement(UserRepository $userRepository,AbonnementRepository $abonnementRepository, int $id): Response
    {
        $user = $userRepository->findOneById($id);
        $abonnements = $abonnementRepository->findOneBy(array('follower' => $id));
        $listeAbonnements = $abonnements->getFollowing();

        

        foreach($user->getFollowings() as $test ){
            dump($test);die();
        }

        return $this->render('user/subList.html.twig', [
            'user' => $user,
            'aboListe' => $listeAbonnements,
        ]);
        
        
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

             //images
            $image = $form->get('image')->getData();

            if($image != null){
                $fichier = md5(uniqid()). '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                $user->setPict($fichier);
            }else{
                $user->setPict('user.png');
            }
            
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

    /**
     * @Route("/sub/{id}", name="sub", methods={"GET"})
     */
    public function sub(UserRepository $UserRepository,AbonnementRepository $abonnementRepository, PostRepository $postRepository, int $id): Response
    {
        
        $following = $UserRepository->findOneById($id); // le compte au quel il s'abonne
        $follower = $this->getUser();// le user qui s'abonne

        if($following->getId() != $follower->getId()){

            $abonnement = $abonnementRepository->findOneBy(array('follower'=> $id) );
            if($abonnement == null){
                $abonnement = new Abonnement;
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $abonnement->setFollower($follower->getId());
            $abonnement->addFollowing($following);
            $entityManager->persist($abonnement);
            $entityManager->flush();

            return $this->redirectToRoute('userProfile', array(
                'id' => $id
            ));
        }

        return $this->render('error.html.twig', [
            'error' => "Vous ne pouvez pas vous connecter à vous même :(",
        ]);   
    }
}
