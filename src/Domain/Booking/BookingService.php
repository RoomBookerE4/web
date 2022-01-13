<?php

namespace App\Domain\Booking;

use App\Domain\Auth\Entity\User;
use App\Domain\Booking\Entity\Booking;
use App\Domain\Booking\Entity\Participant;
use App\Domain\Booking\Entity\Room;
use App\Domain\Booking\Exception\CannotBookException;
use App\Domain\Booking\Repository\BookingRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Handles mutations for Booking.
 */
class BookingService{

    public function __construct(
        private EntityManagerInterface $em,
        private BookingRepository $bookingRepository
    )
    {
        
    }

    /**
     * Book a Room, with according datas.
     *
     * @param BookingFormDTO $dto
     * @return Booking
     */
    public function book(BookingFormDTO $dto, User $user): Booking
    {
        $booking = new Booking();

        // Set the organizer of the meeting.
        $organizer = (new Participant())->setUser($user)->setIsInvitation(false)->setInvitationStatus(InvitationStatus::ACCEPTED);

        // Get date params as int. No other way found to do this easily, according to our input.
        $year = (int) $dto->getDate()->format('Y');
        $month = (int) $dto->getDate()->format('m');
        $day = (int) $dto->getDate()->format('d');

        $startDateTime = DateTime::createFromInterface($dto->getTimeStart())->setDate($year, $month, $day);
        $endDateTime = DateTime::createFromInterface($dto->getTimeEnd())->setDate($year, $month, $day);

        // Assert that time end is AFTER the time start.
        if($endDateTime < $startDateTime)
        {
            throw new CannotBookException("Impossible d'avoir une heure de fin inférieure à l'heure de début.", 500, null);
        }
        // TODO : Check if the room is already booked at that time.

        $booking->setRoom($dto->getRoom());
        $booking->setTimeStart($startDateTime);
        $booking->setTimeEnd($endDateTime);
        // We add the participants. First, the organizer. Then, the others.
        $booking->addParticipant($organizer);

        /** @var \App\Domain\Auth\Entity\User $participantUser */
        foreach ($dto->getParticipants() as $participantUser) {
            // Check if the current organizer is mentionned as participant and skip him/her.
            if($participantUser === $user){
                continue; // onto next participant.
            }

            $booking->addParticipant(
                (new Participant())
                    ->setUser($participantUser)
                    ->setIsInvitation(true)
                    ->setInvitationStatus(InvitationStatus::ACCEPTED)
            );

            // TODO : SEND E-MAILS TO EACH PARTICIPANT
            try{
                // Send email.
            }
            catch(\Exception $e){
                throw new CannotBookException("Envoi de mail impossible.", 1, $e);
                
            }
        }

        try{
            $this->em->persist($booking);
            $this->em->flush();
        }
        catch(\Exception $e){
            throw new CannotBookException("Impossible d'enregistrer la réservation.");
        }
        

        return $booking;
    }

    /**
     * Find meetings. Aggregate function useful for internal use only.
     * CAUTION : This method can be deleted in next version.
     *
     * @param User|null $user
     * @param Room|null $room
     * @param DateTimeInterface|null $start
     * @param DateTimeInterface|null $end
     * @return array
     */
    private function findMeetings(?User $user = null, ?Room $room = null, ?DateTimeInterface $start = null, ?DateTimeInterface $end = null): array
    {
        return $this->bookingRepository->findMeetings($user, $room, $start, $end);
    }

    /**
     * Find only upcoming meetings, for specified user.
     *
     * @param User $user
     * @return void
     */
    public function upcomingMeetings(User $user): array
    {
        return $this->findMeetings($user, null, new \DateTime());
    }

    /**
     * Fin ALL ended meetings until now for a specified - or not - user.
     *
     * @param User|null $user
     * @return array
     */
    public function endedMeetings(?User $user): array
    {
        return $this->findMeetings($user, null, null, new \DateTime());
    }

    /**
     * Checks wether a room is booked or not at a given time.
     *
     * @param Room $room
     * @param DateTime $start
     * @param DateTime $end
     * @return boolean
     */
    public function isRoomBooked(Room $room, DateTime $start, DateTime $end): bool
    {
        $meetings = $this->bookingRepository->findMeetings(null, $room, $start, $end);

        // Checks wether the meetings are "null" or a proper array ... ternary

        return true;
    }

}