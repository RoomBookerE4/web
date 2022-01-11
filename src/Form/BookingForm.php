<?php

namespace App\Form;

use App\Domain\Auth\Entity\User;
use App\Domain\Booking\Entity\Room;
use App\Domain\Booking\BookingFormDTO;
use Symfony\Component\Form\AbstractType;
use App\Domain\Booking\Entity\Reservation;
use DateTime;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BookingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Date de la réservation',
                'data' => new DateTime()
            ])
            ->add('timeStart', TimeType::class, [
                'hours' => [5, 6, 7, 8, 9, 10], 
                'minutes' => range(0, 59, 5), 
                'label' => 'Heure de début'
            ])
            ->add('timeEnd', TimeType::class, [
                'hours' => [5, 6, 7, 8, 9, 10],
                'minutes' => range(0, 59, 5),
                'label' => 'Heure de fin'
            ])
            ->add('room', EntityType::class, [
                'label' => 'Salle',
                'required' => true,
                'class' => Room::class
            ])
            ->add('participants', EntityType::class, [
                'label' => 'Participants (optionnel)',
                'required' => false,
                'class' => User::class,
                'multiple' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Réserver'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookingFormDTO::class,
        ]);
    }
}
