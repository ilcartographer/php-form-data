<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/2/16
 * Time: 6:30 PM
 */

namespace PdfFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DeveloperLineItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('hourlyPrice', MoneyType::class, ['currency' => 'USD'])
            ->add('hours', NumberType::class, ['scale' => 2])
            ->add('total', MoneyType::class, ['currency' => 'USD', 'mapped' => false, 'disabled' => true]);  // Will be populated by jQuery
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PdfFormBundle\Model\DeveloperLineItem',
        ));
    }
}