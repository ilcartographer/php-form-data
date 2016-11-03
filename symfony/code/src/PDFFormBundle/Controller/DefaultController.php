<?php

namespace PdfFormBundle\Controller;

use PdfFormBundle\Form\DeveloperInvoiceType;
use PdfFormBundle\Model\DeveloperInvoice;
use PdfFormBundle\Model\DeveloperLineItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/invoice")
     */
    public function invoiceAction()
    {
        $invoiceForm = $this->createForm(DeveloperInvoiceType::class, new DeveloperInvoice(), ['attr' => ['class' => 'form-horizontal']]);
        return $this->render('PDFFormBundle:Default:invoice.html.twig', ['invoice' => $invoiceForm->createView()]);
    }

    /**
     * @Route("/invoice/dummy")
     */
    public function sampleAction()
    {
        $invoice = new DeveloperInvoice();

        $invoice->setInvoiceDate('01/01/2016');
        $invoice->setInvoiceId(123456);
        $invoice->setCustomerId('123ABC');
        $invoice->setBillingAddress("123 Billing Street\nPdfville, WA 12345");

        $dummyDeveloper = new DeveloperLineItem();
        $dummyDeveloper->setName('Developer');
        $dummyDeveloper->setDescription('Did some work');
        $dummyDeveloper->setHourlyPrice(40.567);
        $dummyDeveloper->setHours(4);

        $invoice->setTaxRate(.05);

        $invoice->setDevelopers([$dummyDeveloper, $dummyDeveloper, $dummyDeveloper, $dummyDeveloper, $dummyDeveloper]);

        $invoice->setComments("Some\ngood\ncomments");

        $saved = $this->get('invoice_pdf.service')->fillDevelopmentInvoice($invoice);

        return new JsonResponse(['error' => $saved->getError()]);
//        return $this->render('PDFFormBundle:Default:dummy.html.twig', ['saved' => $saved]);
    }
}
