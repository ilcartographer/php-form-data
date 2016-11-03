<?php

namespace PDFFormBundle\Controller;

use PDFFormBundle\Form\DeveloperInvoiceType;
use PDFFormBundle\Model\DeveloperInvoice;
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
        $invoice->setInvoiceId(123456);

        $saved = $this->get('invoice_pdf.service')->fillDevelopmentInvoice($invoice);

        return new JsonResponse(['error' => $saved->getError()]);
//        return $this->render('PDFFormBundle:Default:dummy.html.twig', ['saved' => $saved]);
    }
}
