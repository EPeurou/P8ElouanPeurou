<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user_list")
     */
    public function listAction(UserRepository $userRepository )
    {
        $currentUser = $this->getUser();
        $getRoles[] = null;
        if($currentUser != null){
            $getRoles=$currentUser->getRoles();
        }
        // dd($getRoles[0]);
        if ($getRoles[0] == 'ROLE_ADMIN'){
            return $this->render('user/list.html.twig', ['users' => $userRepository->findAll()]);
        } else {
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/users/create", name="user_create")
     */
    public function createAction(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine)
    {
        $currentUser = $this->getUser();
        $getRoles[] = null;
        if($currentUser != null){
            $getRoles=$currentUser->getRoles();
        }
        // dd($getRoles[0]);
        if ($getRoles[0] == 'ROLE_ADMIN'){
            $user = new User();
            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $em = $this->getDoctrine()->getManager();
                $plaintextPassword  = $form->get('password')->getData();
                // $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hashedPassword);

                $entityManager = $doctrine->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', "L'utilisateur a bien été ajouté.");

                return $this->redirectToRoute('login');
            }

            return $this->render('user/create.html.twig', ['form' => $form->createView()]);
        } else { 
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/users/{id}/edit", name="user_edit")
     */
    public function editAction(User $user, Request $request,UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine)
    {
        $currentUser = $this->getUser();
        $getRoles[] = null;
        if($currentUser != null){
            $getRoles=$currentUser->getRoles();
        }
        // dd($getRoles[0]);
        if ($getRoles[0] == 'ROLE_ADMIN'){
            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $plaintextPassword  = $form->get('password')->getData();
                // $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hashedPassword);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', "L'utilisateur a bien été modifié");
                return $this->redirectToRoute('login');
            }

            return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
        } else {
            return $this->redirectToRoute('login');
        }
    }
}
