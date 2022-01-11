<?php

namespace App\Controller;

use App\Form\BookingForm;
use App\Domain\Booking\BookingFormDTO;
use App\Domain\Booking\BookingService;
use App\Domain\Booking\Entity\Booking;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Booking\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    public function __construct(private BookingService $bookingService)
    {
        
    }

    #[Route('/booking', name: 'booking')]
    public function booking(Request $request): Response
    {
        $booking = new BookingFormDTO();
        $form = $this->createForm(BookingForm::class, $booking, ['action' => $this->generateUrl('booking')]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $booking = $form->getData();
            dump($booking);
            
            $this->bookingService->book($booking);

            $this->addFlash('success', 'Reservation effectuée ! Vive Beaudoux!');

            return $this->render('home/index.html.twig', [
                'controller_name' => "success"
            ]);
        }

        return $this->render('booking/_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
