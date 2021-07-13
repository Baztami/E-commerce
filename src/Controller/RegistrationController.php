<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @Route("/inscription",name="registration")
     */
 public function regitration(Request $request,EntityManagerInterface $objectManager,UserPasswordEncoderInterface $encoder)
 {
    $user=new User();
     $form=$this->createForm(RegistrationType::class,$user);
     $form->handleRequest($request);
     if($form->isSubmitted() && $form->isValid()) {

        $plainPassword=$user->getPassword();
        $hash = $encoder->encodePassword($user,$plainPassword);

        $user->setPassword($hash);
        $objectManager->persist($user);
        $objectManager->flush();

     }
     return $this->render("login/index.html.twig",[
    
        'form' => $form->createView()

     ]);





 }
}
