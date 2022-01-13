<?php

namespace App\Controller;

use App\Domain\Booking\BookingService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private BookingService $bookingService)
    {
        
    }

    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'meetings' => $this->bookingService->upcomingMeetings($this->getUser())
        ]);
    }
}
