<?php

namespace App\Controller\Front; 


use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController  extends AbstractController
{
    public function __construct(
        private ListingRepository $listingRepository,
      ) { }

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('front/home/index.html.twig', [
            'listings' => $this->listingRepository->findBy([], ['createdAt' => 'DESC'], 9),
        ]);
    }
}
