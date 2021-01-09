<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {

        return $this->render('users/login.html.twig', [
        ]);
    }

        /**
     * @Route("/register", name="register")
     */
    public function register(UsersRepository $userRepo, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getUPass());
            $user->setUPass($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('login');
        }
        return $this->render('users/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

       /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {

        return $this->render('users/logout.html.twig', [
        ]);
    }

}
