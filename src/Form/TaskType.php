<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => "Titre",'attr'=>[
                'class'=>'form-control w-50'
            ]])
            ->add('content', TextareaType::class, ['label' => "Contenu",'attr'=>[
                'class'=>'form-control w-50'
            ]])
            //->add('author') ===> must be the user authenticated
        ;
    }
}
