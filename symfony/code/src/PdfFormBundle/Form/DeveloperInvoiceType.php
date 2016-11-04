<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/1/16
 * Time: 8:30 PM
 */
namespace PdfFormBundle\Form;

use Braincrafted\Bundle\BootstrapBundle\Form\Type\BootstrapCollectionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add(
                    'developers',
                    BootstrapCollectionType::class,
                    array(
                        'allow_add'          => true,
                        'allow_delete'       => true,
                        'add_button_text'    => 'Add Developer',
                        'delete_button_text' => 'Delete Developer',
                        'entry_type'         => DeveloperLineItemType::class,
                        'sub_widget_col'     => 9,
                        'button_col'         => 3
                    )
                )
            ->add('taxRate', PercentType::class, ['scale' => 5])
            ->add('comments', TextareaType::class)
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PdfFormBundle\Model\DeveloperInvoice',
        ));
    }
}