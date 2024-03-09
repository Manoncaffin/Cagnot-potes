<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\Participant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('content')
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('goal')
            ->add('name')
            // ->add('participants', EntityType::class, [
            //     'class' => Participant::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ]);

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-large waves-effect waves-light pink lighten-1 col s12" style="margin-top: 20px;'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
