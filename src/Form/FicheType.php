<?php

namespace App\Form;

use App\Entity\Fiche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entity = $builder->getData();

        $builder
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('address', null, [
                'label' => 'Adresse',
            ])
            ->add('email', null, [
                'label' => 'Email',
            ])
            ->add('phone', null, [
                'label' => 'Numéro de téléphone',
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'attr' => ['class' => 'form-control'],
                'data_class' => null,
                //'empty_data' => $entity->getImage(),
                //'required' => false,
            ])
            ->add('food_type', null, [
                'label' => 'Type de nourriture sur place',
            ])
            ->add('recommandations', null, [
                'label' => 'Nos recommandations',
            ])
            ->add('schedule', null, [
                'label' => 'Les horaires d\'ouverture et/ou le meilleur moment pour s\'y rendre',
            ])
            ->add('prices', null, [
                'label' => 'Gamme de prix',
            ])
            ->add('fb_link', null, [
                'label' => 'Lien de la page facebook',
            ])
            ->add('insta_link', null, [
                'label' => 'Lien du profil instagram',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fiche::class,
        ]);
    }
}
