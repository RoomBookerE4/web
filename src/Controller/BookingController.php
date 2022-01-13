<?php

namespace App\Controller;

use App\Domain\Auth\UserService;
use App\Form\BookingForm;
use App\Domain\Booking\BookingFormDTO;
use App\Domain\Booking\BookingService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Booking\Exception\CannotBookException;

class BookingController extends AbstractController
{
    public function __construct(
        private BookingService $bookingService
    )
    {
        
    }

    #[Route('/booking', name: 'booking')]
    public function booking(Request $request): Response
    {
        $booking = new BookingFormDTO();
        $form = $this->createForm(BookingForm::class, $booking, [
            'action' => $this->generateUrl('booking'),
            'openedHours' => $this->getEstblishmentOpeningRange(),
            'establishment' => $this->getUserOrThrow()->getEstablishment(),
            'currentUser' => $this->getUserEntity()
        ]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $booking = $form->getData();
            
            try{
                $this->bookingService->book($booking, $this->getUser());
            }
            catch(CannotBookException $e){
                $this->addFlash('danger', 'Impossible de réserver la salle.');
            }

            $this->addFlash('success', 'Reservation effectuée !');

            return $this->redirectToRoute('home');
        }

        return $this->render('booking/_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Establishment opening range.
     * 
     * An estblishment is defined by its timeOpen and timeClose, within we can book a room. Outside this time window,
     * it is impossible to book a room.
     * This method returns the opened hours as a range of opened hours.
     * 
     *
     * @return array [9, 10, 11, ..., 20] for example.
     */
    private function getEstblishmentOpeningRange(): array
    {
        return range(
            (int) $this->getUserOrThrow()->getEstablishment()->getTimeopen()->format('H'),
            (int) $this->getUserOrThrow()->getEstablishment()->getTimeclose()->format('H') - 1, // Minus 1 to be sure we can't book a room at 18:55 if the institution closes at 18:00.
            1
        );
    }
}
