<?php

namespace App\Controller;

use App\Domain\Booking\BookingService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private BookingService $bookingService)
    {
        
    }

    #[Route('/home', name: 'home')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'meetings' => $this->bookingService->upcomingMeetings($this->getUser())
        ]);
    }
}
