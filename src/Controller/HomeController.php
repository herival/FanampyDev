<?php

namespace App\Controller;

use App\Repository\ShareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ShareRepository $shareRepository): Response
    {
        $liste = $shareRepository->findBy([],['id'=>'DESC'],4,[]);
        return $this->render('home/home.html.twig', [
            'liste' => $liste,
        ]);
    }

    /**
     * @Route("/defaultsite", name="redirection")
     */
    public function redirection(): Response
    {
        return $this->redirectToRoute('home');
    }
}
