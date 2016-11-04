<?php

namespace PdfFormBundle\Controller;

use PdfFormBundle\Form\DeveloperInvoiceType;
use PdfFormBundle\Model\DeveloperInvoice;
use PdfFormBundle\Model\DeveloperLineItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Displays an invoice form that can be submitted to fill in the invoice PDF template
     * @Route("/invoice")
     */
    public function invoiceAction(Request $request)
    {
        $invoiceForm = $this->createForm(DeveloperInvoiceType::class, new DeveloperInvoice());

        // If this was a post, validate the form
        if ($request->isMethod('POST')) {
            $invoiceForm->submit($request->request->get($invoiceForm->getName()));

            if ($invoiceForm->isValid()) {
                // Generate a unique name for the file being requested
                $fileName = uniqid();

                // Fill out the PDF with the validated form data
                $this->get('invoice_pdf.service')->fillDevelopmentInvoice($invoiceForm->getData(), $fileName);
                return new BinaryFileResponse($this->get('kernel')->getRootDir() . '/../web' . '/filled_forms/' . $fileName . '.pdf');
            }
        }

        // Return the form; If post request, this will display errors
        return $this->render('PdfFormBundle:Default:invoice.html.twig', ['invoice' => $invoiceForm->createView()]);
    }
}
