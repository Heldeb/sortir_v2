<?php

namespace App\Form;

use App\Entity\Filtres;
use App\Entity\Lieu;
use App\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class FiltresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('site', EntityType::class, [
                'class' => Site::class,
                'choice_label' => 'nom',
                'required' => false,
            ])

            ->add('contient', TextType::class, [
                //'class' => Sortie::class,
                'label' => 'Le nom de la sortie contient : ',
                'required' => false,
                ])

            ->add('datedebut', DateType::class, [
                'label'=>'Entre ',
                'html5' => true,
                'widget' => 'single_text',
                'required' => false,
                ])
            ->add('datecloture', DateType::class, [
                'label'=>'Entre ',
                'html5' => true,
                'widget' => 'single_text',
                'required' => false,
            ]);

            /*
            ->add('organisateur',CheckboxType::class,[
                'label'=>'Sorties dont je suis l\'organisateur/trice',
                'required' => false
            ])
            ->add('inscrit',CheckboxType::class,[
                'label'=>'Sorties auxquelles je suis inscrit/e',
                'required' => false
            ])
            ->add('nonInscrit',CheckboxType::class,[
                'label'=>'Sorties auxquelles je ne suis pas inscrit/e',
                'required' => false
            ])
            ->add('sortiePassee',CheckboxType::class,[
                'label'=>'Sorties passées',
                'required' => false
            ])
        ; */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filtres::class,
        ]);
    }
}
