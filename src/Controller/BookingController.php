<?php

namespace App\Controller;

use App\Form\BookingForm;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Booking\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'booking')]
    public function booking(Request $request, ManagerRegistry $manager_registry): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(BookingForm::class, $reservation, ['action' => $this->generateUrl('booking')]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $reservation = $form->getData();
            dump($reservation);
            $manager_registry->getManager()->persist($reservation);
            $manager_registry->getManager()->flush();

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
