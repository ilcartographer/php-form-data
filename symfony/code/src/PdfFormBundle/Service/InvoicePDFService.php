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
use PdfFormBundle\Model\DeveloperLineItem;

// TODO: Make service interface
class InvoicePDFService
{
    // TODO: This can be abstracted to a base class, e.g. fillPdfData(AbstractPdfModel $model, $templateName, $outputName)
    /**
     * Generate a PDF file based on the template, with data filled in from the submitted form data
     *
     * @param DeveloperInvoice $invoice
     * @param $fileName Name of file without the .pdf extension
     * @return Pdf
     */
    public function fillDevelopmentInvoice(DeveloperInvoice $invoice, $fileName) {
        $pdf = new Pdf('invoice-and-receipt-template.pdf');

        $pdf->fillForm($this->generateFormFieldArray($invoice))
            ->needAppearances()
            ->saveAs('filled_forms/' . $fileName . '.pdf');


        return $pdf;
    }

    // TODO: This would be overriden by each subclass
    /**
     * Generate the array to be used as the PDF form fields
     *
     * @param DeveloperInvoice $invoice
     * @return array
     */
    protected function generateFormFieldArray(DeveloperInvoice $invoice) {
        $invoiceArray = [];

        // Format the date as month/day/year
        $invoiceArray['date'] = $invoice->getInvoiceDate()->format('m/d/Y');
        $invoiceArray['invoice_number'] = $invoice->getInvoiceId();
        $invoiceArray['customer_id'] = $invoice->getCustomerId();

        $invoiceArray['bill_to'] = $invoice->getBillingAddress();

        // The form provided has default values for these, so going to clear them
        for($i = 1; $i <= 5; $i++) {
            $invoiceArray['developer_' . $i] = '';
            $invoiceArray['description_' . $i] = '';
            $invoiceArray['hourly_rate_' . $i] = '';
            $invoiceArray['hours_' . $i] = '';
            $invoiceArray['total_price_' . $i] = '';
        }

        // Now, set the actual values for the developer lines
        if(!empty($invoice->getDevelopers() && is_array($invoice->getDevelopers()))) {
            foreach($invoice->getDevelopers() as $index => $developer) {
                // Entry must be an instance of the developer line item
                if(!($developer instanceof DeveloperLineItem)) {
                    continue;
                }
                // This should be validated prior to calling this, but ignorning excessive developers
                if($index > 5) {
                    break;
                }

                $invoiceArray['developer_' . ($index + 1)] = $developer->getName();
                $invoiceArray['description_' . ($index + 1)] = $developer->getDescription();
                $invoiceArray['hourly_rate_' . ($index + 1)] = $developer->getHourlyPrice();
                $invoiceArray['hours_' . ($index + 1)] = $developer->getHours();
                $invoiceArray['total_price_' . ($index + 1)] = $developer->getDeveloperTotalPrice();
;
            }
        }

        $invoiceArray['subtotal'] = $invoice->getInvoiceSubtotal();
        $invoiceArray['tax'] = $invoice->getInvoiceTax();
        $invoiceArray['total'] = $invoice->getInvoiceTotal();

        $invoiceArray['comments'] = $invoice->getComments();

        return $invoiceArray;
    }
}