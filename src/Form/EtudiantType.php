<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Maison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
			      ->add('dateNaissance', DateType::class, array(
                'placeholder' => array('years' => 'Years', 'months' => 'Months', 'days' => 'Days'),
                'years' => range(1900,2018)
              ))

            ->add('ville', TextType::class)
            ->add('numRue', TextType::class)
            ->add('rue', TextType::class)
            ->add('copos', TextType::class)
            //->add('sexe')
            ->add('surnom', TextType::class)
            ->add('maison', EntityType::class, array('class' => 'App\Entity\Maison','choice_label' => 'libelle' ))
            //->add('promotion')
	    ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel étudiant'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
