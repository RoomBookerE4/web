<?php

namespace App\Domain\Booking;

use DateTimeInterface;

class EstablishmentFormDTO{
    public string $name;
    public string $address;
    public DateTimeInterface $timeOpen;
    public DateTimeInterface $timeClose;

    public string $userName;
    public string $userSurname;
    public string $userEmail;
    public string $userPassword;
}