<?php

namespace App\Form;

use App\Entity\Filtres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('site_id')
            ->add('nom_lieu')
            ->add('datedebut', null, [
                'widget' => 'single_text',
            ])
            ->add('datecloture', null, [
                'widget' => 'single_text',
            ])
            ->add('inscription_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filtres::class,
        ]);
    }
}
