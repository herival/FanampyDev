<?php

namespace App\Form;

use App\Entity\Share;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ShareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Anarana'
            ])
            ->add('illustration', FileType::class, [
                'label' => 'Kisary fanehoana',
                'mapped' => false,
                'required' => false, 
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Sary iany no azo ampidirina',
                    ])
                ]
                
            ])
            ->add('file', FileType::class, [
                'label' => 'Rakitra',
                'mapped' => false,
                'required' => true
                
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Fanazavana fohy',
            ]

            )
            ->add('submit', SubmitType::class, [
                'label' => 'Ampidiriko',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ]

            )

      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Share::class,
        ]);
    }
}
