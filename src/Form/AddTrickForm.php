<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\File;

class AddTrickForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du trick',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer un nom pour le trick']),
                    new Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'Le nom du trick doit comporter au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom du trick ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'constraints' => [new NotBlank(['message' => 'Veuillez sélectionner une catégorie'])]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'constraints' => [new NotBlank(['message' => 'Veuillez entrer une description'])]
            ])
            ->add('images', FileType::class, [
                'label' => 'Images',
                'required' => false,
                'mapped' => false,
                'multiple' => true, // Permet de télécharger plusieurs fichiers
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG, GIF)'
                    ])
                ]
            ])
            ->add('videoUrl', UrlType::class, [
                'label' => 'URL de la vidéo',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'URL de la vidéo (YouTube, Vimeo, etc.)'
                ],
                'constraints' => [
                    new Url(['message' => 'Veuillez entrer une URL valide'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
