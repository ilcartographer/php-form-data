<?php

namespace PDFFormBundle\Controller;

use PDFFormBundle\Form\DeveloperInvoiceType;
use PDFFormBundle\Model\DeveloperInvoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('PDFFormBundle:Default:index.html.twig');
    }

    /**
     * @Route("/invoice")
     */
    public function invoiceAction()
    {
        $invoiceForm = $this->createForm(DeveloperInvoiceType::class, new DeveloperInvoice());
        return $this->render('PDFFormBundle:Default:invoice.html.twig', ['invoice' => $invoiceForm->createView()]);
    }
}
