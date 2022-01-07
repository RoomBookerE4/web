<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Domain\Booking\Entity\Reservation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('timeStart', TimeType::class, ['hours' => [5, 6, 7, 8, 9, 10], 'minutes' => range(0, 59, 5), 'label' => 'Heure de début'])
            ->add('timeEnd', TimeType::class, ['hours' => [5, 6, 7, 8, 9, 10], 'minutes' => range(0, 59, 5), 'label' => 'Heure de fin'])
            ->add('room', null, ['label' => 'Salle'])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
