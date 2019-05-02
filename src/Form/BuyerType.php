<?php

namespace App\Form;

use App\Entity\Buyer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BuyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [
            'Journée' => 'valeur1',
            'Demi-journée' => 'valeur2'
        ];

        $builder
            ->add('nbBillet', ChoiceType::class, [
                'choices' => [
                    '0','1','2','3','4','5','6','7','8','9','10'
                ]
             ])
            ->add('typeBillet', ChoiceType::class, [
                'choices' => 'valeur1',
                    'choices' => $choices,
                    'expanded' => false,                            
         ])
            ->add('createdAt', DateType::class, [
                'format' => 'ddMMyyyy',
             ])
            ->add('email')
            
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Buyer::class,
        ]);
    }
}
