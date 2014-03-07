<?php

namespace PrayerToShare\Bundle\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anonymous', 'checkbox', array(
                'label' => 'Post Anonymously',
                'required' => false,
            ))
            ->add('text', 'textarea')
            ->add('submit', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PrayerToShare\Bundle\MainBundle\Entity\Prayer',
        ));
    }

    public function getName()
    {
        return 'prayer';
    }
}
