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
        $builder
            ->add('city', ChoiceType::class, [
                'label' => 'Ville',
                'choices' => [
                    'New York City' => 'New York City','Los Angeles' => 'Los Angeles','Beijing' => 'Beijing','Delhi' => 'Delhi','Shanghai' => 'Shanghai','Paris' => 'Paris','Istanbul' => 'Istanbul','Tokyo' => 'Tokyo','Guangzhou' => 'Guangzhou','Mumbai' => 'Mumbai','Moscow' => 'Moscow','São Paulo' => 'São Paulo','Shenzhen' => 'Shenzhen','Jakarta' => 'Jakarta','Lahore' => 'Lahore','Seoul' => 'Seoul','Wuhan' => 'Wuhan','Kinshasa' => 'Kinshasa','Cairo' => 'Cairo','Mexico City' => 'Mexico City','Lima' => 'Lima','London' => 'London','Lagos' => 'Lagos','Bengaluru' => 'Bengaluru','Bangkok' => 'Bangkok','Ho Chi Minh City' => 'Ho Chi Minh City','Dongguan' => 'Dongguan','Chongqing' => 'Chongqing','Nanjing' => 'Nanjing','Tehran' => 'Tehran','Shenyang' => 'Shenyang','Bogotá' => 'Bogotá','Ningbo' => 'Ningbo','Hong Kong' => 'Hong Kong','Hanoi' => 'Hanoi','Baghdad' => 'Baghdad','Changsha' => 'Changsha','Dhaka' => 'Dhaka','Hyderabad' => 'Hyderabad','Chennai' => 'Chennai','Rio de Janeiro' => 'Rio de Janeiro','Faisalabad' => 'Faisalabad','Foshan' => 'Foshan','Zunyi' => 'Zunyi','Santiago' => 'Santiago','Riyadh' => 'Riyadh','Ahmedabad' => 'Ahmedabad','Singapore' => 'Singapore','Shantou' => 'Shantou','Saint Petersburg' => 'Saint Petersburg','Yangon' => 'Yangon','Abidjan' => 'Abidjan','Chengdu' => 'Chengdu','Alexandria' => 'Alexandria','Kolkata' => 'Kolkata','Ankara' => 'Ankara','Xi\'an' => 'Xi\'an','Surat' => 'Surat','Johannesburg' => 'Johannesburg','Dar es Salaam' => 'Dar es Salaam','Suzhou' => 'Suzhou','Harbin' => 'Harbin','Giza' => 'Giza','Zhengzhou' => 'Zhengzhou','New Taipei City' => 'New Taipei City','Karachi' => 'Karachi','Cape Town' => 'Cape Town','Yokohama' => 'Yokohama','Berlin' => 'Berlin','Busan' => 'Busan','Hangzhou' => 'Hangzhou','Xiamen' => 'Xiamen','Quanzhou' => 'Quanzhou','Rawalpindi' => 'Rawalpindi','Jeddah' => 'Jeddah','Durban' => 'Durban','Hyderabad' => 'Hyderabad','Kabul' => 'Kabul','Casablanca' => 'Casablanca','Hefei' => 'Hefei','Pyongyang' => 'Pyongyang','Madrid' => 'Madrid','Peshawar' => 'Peshawar','Ekurhuleni' => 'Ekurhuleni','Nairobi' => 'Nairobi','Zhongshan' => 'Zhongshan','Pune' => 'Pune','Addis Ababa' => 'Addis Ababa','Jaipur' => 'Jaipur','Buenos Aires' => 'Buenos Aires','Wenzhou' => 'Wenzhou',
                ],
            ])
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
        $entity = $builder->getData();

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fiche::class,
        ]);
    }
}
