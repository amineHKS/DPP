<?php

namespace App\Form;

use App\Entity\Distance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address_ip')
            ->add('address_number')
            ->add('address_street')
            ->add('address_postal_code')
            ->add('address_city')
            ->add('address_country')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Distance::class,
        ]);
    }
}
