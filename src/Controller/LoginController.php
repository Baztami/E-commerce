<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @Route("/inscription",name="registration")
     */
 public function regitration(Request $request,EntityManagerInterface $objectManager)
 {
    $user=new User();
     $form=$this->createForm(RegistrationType::class,$user);
     $form->handleRequest($request);
     if($form->isSubmitted() && $form->isValid()) {

        $objectManager->persist($user);
        $objectManager->flush();

     }
     return $this->render("login/index.html.twig",[
    
        'form' => $form->createView()

     ]);





 }
}
