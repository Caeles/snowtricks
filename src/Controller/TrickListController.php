<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Trick;
use App\Repository\TrickRepository;

final class TrickListController extends AbstractController
{
    #[Route('/trick_list', name: 'app_trick_list')]
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findBy([], ['createdAt' => 'DESC']);
        
        return $this->render('trick_list/index.html.twig', [
            'tricks' => $tricks,
            'title' => 'Liste de tous les tricks',
        ]);
    }
}
