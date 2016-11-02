<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/1/16
 * Time: 8:30 PM
 */
namespace PDFFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DeveloperInvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('invoiceDate', DateType::class)
            ->add('invoiceId', NumberType::class)
            ->add('customerId', TextType::class)
            ->add('billingAddress', TextareaType::class)
            // TODO: Developer invoices
            ->add('taxRate', PercentType::class, ['scale' => 5])
            ->add('comments', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PDFFormBundle\Model\DeveloperInvoice',
        ));
    }
}