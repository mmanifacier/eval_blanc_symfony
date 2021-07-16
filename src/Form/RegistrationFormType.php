<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr'=> [
                    'class'=>'form-control',
                    'placeholder'=>'Indiquez votre username'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped'=>false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class'=>'form-control',
                    'placeholder'=>'Indiquez votre password'
                ],
                'invalid_message' => 'The password fields must match.',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('email', EmailType::class, [
                'attr'=> [
                    'class'=>'form-control',
                    'placeholder'=>'Indiquez votre email'
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr'=> [
                    'class'=>'form-control',
                    'placeholder'=>'Indiquez votre firstname'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr'=> [
                    'class'=>'form-control',
                    'placeholder'=>'Indiquez votre lastname'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
