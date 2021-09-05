<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class IdentificationForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifiant', TextType::class, ['label' => 'Identifiant : '])
            ->add('mot_de_passe', PasswordType::class, ['label' => 'Mot De Passe : '])
            ->add('submit', SubmitType::class, ['label' => 'Valider']);
    }
    
    
}

