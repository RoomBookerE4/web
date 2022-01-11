<?php

namespace App\Domain\Booking;

use App\Domain\Booking\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;

/**
 * Handles mutations for Booking.
 */
class BookingService{

    public function __construct(private EntityManagerInterface $em)
    {
        
    }

    /**
     * Book a Room, with according datas.
     *
     * @param BookingFormDTO $dto
     * @return Booking
     */
    public function book(BookingFormDTO $dto): Booking
    {
        $booking = new Booking();

        dump($dto);
        // TODO : IL FAUT AJOUTER LA DATE AUX AUTRES ELEMENTS !
        //$dto->getTimeStart()->setDate();


        /**
         * Do a little bit of validation.
         */
        // Assert that time end is AFTER the time start.
        if($dto->getTimeEnd() < $dto->getTimeStart())
        {
            throw new DomainException("Impossible d'avoir une heure de fin inférieure à l'heure de début.", 500);
        }

        $booking->setRoom($dto->getRoom());
        $booking->setTimeStart($dto->getTimeStart());
        $booking->setTimeEnd($dto->getTimeEnd());

        $this->em->persist($booking);
        $this->em->flush();

        return $booking;
    }

}