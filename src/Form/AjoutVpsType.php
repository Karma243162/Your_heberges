<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AjoutVpsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('prix', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('processeur', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('stockage', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('ram', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('ip', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('bandepassante', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('localisation', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold text-dark']])
        ->add('Confirmer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center text-white'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
