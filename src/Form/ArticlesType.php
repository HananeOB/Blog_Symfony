<?php

namespace App\Form;

use App\Entity\Articles;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('slug')
            ->add('contenu')
            ->add('dateCreation',  DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',])
            //->add('dateMaj')
            ->add('image', FileType::class, [
                'label' => 'Choisir une image',
                'data_class' => null,
                
            ])
            // ->add('user', EntityType::class, array(
            //     'label' => "Créateur",
            //     'required'   => true,
            //     'class' => 'App:Users',
            //     'choice_attr' => array(
            //         'data-tokens' => 'email'
            //     ),
            //     'choice_label' => 'email',
            //     'multiple' => false,
            //     ))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
