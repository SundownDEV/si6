<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Status', ChoiceType::class, [
                'label' => 'Vous êtes...',
                'choices' => [
                    'Annonceur' => 'Annonceur',
                    'Journaliste' => 'Journaliste',
                    'Partenaire' => 'Partenaire',
                    'Lecteur' => 'Lecteur',
                    'Office de tourisme' => 'Office de tourisme',
                ],
            ])
            ->add('Company', null, [])
            ->add('Name', null, [])
            ->add('Email', null, [])
            ->add('phone', null, [])
            ->add('message', null, [])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
