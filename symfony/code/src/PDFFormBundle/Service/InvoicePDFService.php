<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/2/16
 * Time: 7:55 PM
 */

namespace PdfFormBundle\Service;


use mikehaertl\pdftk\Pdf;
use PdfFormBundle\Model\DeveloperInvoice;

// TODO: Make service interface
class InvoicePDFService
{
    // TODO: This can be abstracted to a base class
    public function fillDevelopmentInvoice(DeveloperInvoice $invoice) {
        $pdf = new Pdf('invoice-and-receipt-template.pdf');

        $pdf->fillForm($this->generateFormFieldArray($invoice))
            ->needAppearances()
            ->saveAs('filled_forms/filled.pdf');


        return $pdf;
    }

    // TODO: This will be overriden by each subclass
    // TODO: This could also be a function of the model class, which could implement a PdfFormData interface or
    //       abstracted in some other way
    protected function generateFormFieldArray(DeveloperInvoice $invoice) {
        $invoiceArray = [];

        $invoiceArray['date'] = $invoice->getInvoiceDate();
        $invoiceArray['invoice_number'] = $invoice->getInvoiceId();
        $invoiceArray['customer_id'] = $invoice->getCustomerId();

        $invoiceArray['bill_to'] = $invoice->getBillingAddress();

        $subtotal = 0;

        if(!empty($invoice->getDevelopers() && is_array($invoice->getDevelopers()))) {
            foreach($invoice->getDevelopers() as $index => $developer) {
                // This should be validated prior to calling this, but ignorning excessive developers
                if($index > 5) {
                    break;
                }

                $invoiceArray['developer_' . ($index + 1)] = $developer->getName();
                $invoiceArray['description_' . ($index + 1)] = $developer->getDescription();
                $invoiceArray['hourly_rate_' . ($index + 1)] = $developer->getHourlyPrice();
                $invoiceArray['hours_' . ($index + 1)] = $developer->getHours();
                $invoiceArray['total_price_' . ($index + 1)] = $developer->getDeveloperTotalPrice();

                $subtotal += $developer->getDeveloperTotalPrice();
            }
        }

        $invoiceArray['subtotal'] = $subtotal;

        $tax = round($subtotal * $invoice->getTaxRate(), 2);
        $invoiceArray['tax'] = $tax;

        $invoiceArray['total'] = $subtotal + $tax;

        $invoiceArray['comments'] = $invoice->getComments();

        return $invoiceArray;
    }
}