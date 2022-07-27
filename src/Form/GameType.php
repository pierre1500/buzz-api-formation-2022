<?php

namespace App\Form;

use App\Entity\GameGenre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Titre',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Titre du jeu',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Description de l\'article',
                ],
            ])
            ->add('plateformes', ChoiceType::class, [
                'choices' => ['PC' => 'PC', 'PS4' => 'PS4', 'XBOX ONE' => 'XBOX ONE', 'SWITCH' => 'SWITCH', 'PS5' => 'PS5'],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('type', NumberType::class, [
                'label' => 'Promotion en %',
                'class' => GameGenre::class,
                'attr' => [
                    'max' => 100,
                    'min' => 0,
                    'placeholder' => 'Type de jeu',
                ],
            ])
            ->add('type', EntityType::class, [
                'label' => 'Type',
                'multiple' => true,
                'class' => GameGenre::class,
                'choice_label' => 'name',
                'attr' => [
                    'placeholder' => 'Type de jeu',
                ],
            ])
            ->add('daterelease', DateTimeType::class, [
                'label' => 'Date de sortie',
                'required' => false,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'placeholder' => 'Date de sortie',
                ],
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prix du jeu',
                ],
            ])
            ->add('promotion', NumberType::class, [
                'label' => 'Promotion en %',
                'required' => false,
                'attr' => [
                    'placeholder' => '19,99',
                ],
            ])
            ->add('attachement', FileType::class, [
                'mapped'=> false,
                'label' => 'Image',
                'multiple' => true,
                'required' => false,
                'attr' => [
                    'accept' => 'image/*',
                    'class'   => 'pomme',
                    'multiple' => true,
                    'placeholder' => 'Image du jeu',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => '➕ Ajouter le jeu',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }

}