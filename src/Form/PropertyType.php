<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Searchoption;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, [
                'choices' => $this->getChoice()
            ])
            ->add('searchoptions', EntityType::class, [
                'class' => Searchoption::class,
                'choice_label' => 'name',
                'label' => 'Options',
                'multiple' => true
            ])
            ->add('pictureFiles', FileType::class, [
                'required' => false,
                'multiple' => true
            ])
            ->add('city')
            ->add('adresse')
            ->add('postal_code')
            ->add('sold')
            ->add('surface');
    }

    private function getChoice()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ($choices as $k => $val) {
            $output[$val] = $k;
        }
        return $output;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
