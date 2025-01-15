<?php

namespace App\Form;

use App\Entity\Age;
use App\Entity\Console;
use App\Entity\Game;
use App\Form\NoteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, [
            'label' => 'Titre du jeu',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description du jeu',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('price', IntegerType::class, [
            'label' => 'Prix du jeu',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('releaseDate', DateTimeType::class, [
            'label' => 'Date de sortie du jeu',
            'widget' => 'single_text',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('image', FileType::class, [
            'label' => 'Image du jeu',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '5000k',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/jpg',
                        'image/gif',
                        'image/webp'
                    ],
                    'mimeTypesMessage' => 'Merci de choisir un format d\'image valide (jpeg, jpg, png, gif, webp)',
                ])
            ],
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('age', EntityType::class, [
            'class' => Age::class,
            'choice_label' => 'label',
            'multiple' => false,
            'label' => 'Restriction d\'âge',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('consoles', EntityType::class, [
            'class' => Console::class,
            'choice_label' => 'label',
            'multiple' => true,
            'expanded' => true,
            'label' => 'Disponible sur'
        ])
        // imbrication du formulaire de notes
        ->add('note', NoteType::class, [
            'label' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class
        ]);
    }
}