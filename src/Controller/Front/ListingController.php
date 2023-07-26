<?php


namespace App\Controller\Front;


use App\Entity\Listing;
use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ListingController extends AbstractController
{

    public function __construct(
        private ListingRepository $listingRepository,
    ) {
    }


    #[Route('/listing', name: 'app_listing')]
    public function index(): Response
    {

        $qb = $this->listingRepository->getQbAll();
        $listings = $qb->getQuery()->getResult();
        return $this->render('front/home/index.html.twig', [
            'listings' => $listings,
        ]);
    }


    #[Route('/listing/{id}', name: 'app_listing_show')]
    public function handleRedirection(string $id, Request $request): Response
    {
        $listing = $this->listingRepository->findOneBy(['id' => $id]);
        return $this->render('front/page/show.html.twig', [
            'listing' => $listing,
        ]);
    }

}
