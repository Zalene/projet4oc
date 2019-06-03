<?php

namespace App\Form;

use App\Entity\Buyer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class BuyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbBillet', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10
                ]
             ])
            ->add('typeBillet', ChoiceType::class, [
                'choices' => [
                    'Journée' => 1,
                    'Demi-Journée' => 0
                ]                            
            ])
            ->add('visitDay', DateType::class, [
                'widget' => 'single_text',
                'html5' => 'false',
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker']
             ])
            ->add('email', EmailType::class, [
                'attr' => ['aria-describedby' => 'basic-addon1']
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Buyer::class,
        ]);
    }
}
