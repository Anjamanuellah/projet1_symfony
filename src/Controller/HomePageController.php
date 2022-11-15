<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/{name?}/{age?}", name="app_home_page")  //paraconverter
     */

    public function index(?string $name,?int $age): Response
    {
        return $this->render('home_page/index.html.twig', [
            "nom"=>$name, 
            "age"=>$age
        ]);
    }
    
    /**
     * @Route("/blog", name="blog_page")
    */
    public function main(): Response
    {
        return $this->render('home_page/main.html.twig', [
        ]);
    }

    /**
     * @Route("/profil", name="profil_page")
    */
    public function profil(): Response
    {
        return $this->render('home_page/profil.html.twig', [
            "name" => "anja"
        ]);
    }
}