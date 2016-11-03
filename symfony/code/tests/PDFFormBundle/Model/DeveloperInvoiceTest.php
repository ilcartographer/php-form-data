<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/2/16
 * Time: 7:38 PM
 */

namespace PdfFormBundle\Tests\Model;


use PdfFormBundle\Model\DeveloperInvoice;
use PdfFormBundle\Model\DeveloperLineItem;

class DeveloperInvoiceTest extends \PHPUnit_Framework_TestCase
{
    public function testInvoiceTotal() {
        $invoice = new DeveloperInvoice();

        $developer1 = new DeveloperLineItem();
        $developer1->setHourlyPrice(3.2);
        $developer1->setHours(2);

        $developer2 = new DeveloperLineItem();
        $developer2->setHourlyPrice(5);
        $developer2->setHours(4);

        $invoice->setDevelopers([$developer1, $developer2]);

        $invoice->setTaxRate(.05);

        $this->assertEquals(27.72, $invoice->getInvoiceTotal());
    }

    public function testInvoiceTotalNoDevelopers() {
        $invoice = new DeveloperInvoice();

        $this->assertEquals(0, $invoice->getInvoiceTotal());
    }

    public function testInvoiceTotalDevelopersNotArray() {
        $invoice = new DeveloperInvoice();

        $invoice->setDevelopers(new DeveloperLineItem());

        $this->assertEquals(0, $invoice->getInvoiceTotal());
    }

    public function testInvoiceNoTaxes() {
        $invoice = new DeveloperInvoice();

        $developer1 = new DeveloperLineItem();
        $developer1->setHourlyPrice(3.2);
        $developer1->setHours(2);

        $developer2 = new DeveloperLineItem();
        $developer2->setHourlyPrice(5);
        $developer2->setHours(4);

        $invoice->setDevelopers([$developer1, $developer2]);

        $this->assertEquals(26.4, $invoice->getInvoiceTotal());
    }
}