<?php

namespace App\Controller;

use App\Repository\ShareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllShareController extends AbstractController
{
    /**
     * @Route("/share/all", name="all_share")
     */
    public function index(ShareRepository $shareRepository): Response
    {
        return $this->render('all_share/index.html.twig', [
            'liste' => $shareRepository->findBy([],['id'=>'DESC']),
        ]);
    }
}
