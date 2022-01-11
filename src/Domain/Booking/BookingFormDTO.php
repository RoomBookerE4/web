<?php

namespace App\Domain\Booking;

use DateTime;
use DateTimeInterface;

use App\Domain\Booking\Entity\Room;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Booking Form DTO.
 */
class BookingFormDTO{

    /**
     * Date of the actual booking.
     *
     * @var DateTimeInterface
     */
    private DateTimeInterface $date;

    /**
     * @var \DateTimeInterface
     */
    private DateTimeInterface $timeStart;

    /**
     * @var \DateTimeInterface
     */
    private DateTimeInterface $timeEnd;

    /**
     * @var Room
     */
    private Room $room;

    /**
     * @var User[]
     *
     * @var ArrayCollection
     */
    private ArrayCollection $participants;


    /**
     * Get date of the actual booking.
     *
     * @return  DateTimeInterface
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date of the actual booking.
     *
     * @param  DateTimeInterface  $date  Date of the actual booking.
     *
     * @return  self
     */ 
    public function setDate(DateTimeInterface $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of timeStart
     *
     * @return  \DateTimeInterface
     */ 
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set the value of timeStart
     *
     * @param  \DateTimeInterface  $timeStart
     *
     * @return  self
     */ 
    public function setTimeStart(\DateTimeInterface $timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get the value of timeEnd
     *
     * @return  \DateTimeInterface
     */ 
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * Set the value of timeEnd
     *
     * @param  \DateTimeInterface  $timeEnd
     *
     * @return  self
     */ 
    public function setTimeEnd(\DateTimeInterface $timeEnd)
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    /**
     * Get the value of room
     *
     * @return  Room
     */ 
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set the value of room
     *
     * @param  Room  $room
     *
     * @return  self
     */ 
    public function setRoom(Room $room)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get the value of participants
     *
     * @return  User[]
     */ 
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set the value of participants
     *
     * @param  User[]  $participants
     *
     * @return  self
     */ 
    public function setParticipants(ArrayCollection $participants)
    {
        $this->participants = $participants;

        return $this;
    }
}