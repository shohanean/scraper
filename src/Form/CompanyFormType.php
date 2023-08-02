<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\{TextType, IntegerType, TextareaType, SubmitType};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CompanyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Company Name',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your name.']),
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Price',
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your Price.']),
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => [
                    'class' => 'btn btn-success mt-3',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
