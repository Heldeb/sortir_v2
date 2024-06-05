<?php

namespace App\Form;

use App\Entity\Etat;
use App\Entity\Inscription;
use App\Entity\Lieu;
use App\Entity\Site;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom de la sortie'
            ])
            ->add('datedebut', null, [
                'label'=>'Date et heure de début',
                'html5'=>'true',
                'widget' => 'single_text',
            ])
            ->add('duree',IntegerType::class, [
                'label'=>'Durée(en minutes)',
                'attr'=>['min'=>0]
            ])
            ->add('datecloture', DateType::class, [
                'label'=>'Date limite d\'inscription',
                'html5'=>'true',
                'widget' => 'single_text',
            ])
            ->add('nbinscriptionsmax', IntegerType::class,[
                'label'=>'Nombre d\'inscription maximum',
                'attr'=>['min'=>0]
            ])
            ->add('descriptioninfos', TextareaType::class,[
                'label'=>'Description et infos'
            ])
            ->add('lieu', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'nom_lieu',
            ])
            ->add('site', EntityType::class, [
                'class' => Site::class,
                'choice_label' => 'nom',
            ])
            ->add('etat', EntityType::class, [
                'class'=>Etat::class,
                'choice_label'=>'libelle'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
