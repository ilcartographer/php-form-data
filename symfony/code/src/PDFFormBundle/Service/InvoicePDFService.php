<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/2/16
 * Time: 7:55 PM
 */

namespace PDFFormBundle\Service;


use mikehaertl\pdftk\Pdf;
use PDFFormBundle\Model\DeveloperInvoice;

class InvoicePDFService
{
    public function fillDevelopmentInvoice(DeveloperInvoice $invoice) {
        $pdf = new Pdf('invoice-and-receipt-template.pdf');

        $pdf->fillForm(array(
            'invoice_number' => $invoice->getInvoiceId(),
        ))
            ->needAppearances()
            ->saveAs('filled_forms/filled.pdf');


        return $pdf;
    }
}