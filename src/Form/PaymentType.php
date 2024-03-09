<?php

namespace App\Form;

use App\Entity\participant;
use App\Entity\Payment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                "label" => false,
            ])
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('participant', EntityType::class, [
            //     'class' => participant::class,
            //     'choice_label' => 'id',
            // ])
            ->add('participant', ParticipantType::class, [
                'data_class' => Participant::class,
                "label" => false,
            ])

            ->add('submit', SubmitType::class, [
            'attr' => [ 
                'class' => 'btn btn-large waves-effect waves-light pink lighten-1 col s12'
                ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
