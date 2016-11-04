<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/1/16
 * Time: 8:28 PM
 */

namespace PdfFormBundle\Model;


class DeveloperInvoice
{
    /**
     * @var \DateTime
     */
    private $invoiceDate;

    /**
     * @var int
     */
    private $invoiceId = 0;

    /**
     * @var string
     */
    private $customerId = '';

    /**
     * @var string
     */
    private $billingAddress = '';

    /**
     * @var array
     */
    private $developers = [];

    /**
     * @var int
     */
    private $taxRate = 0;

    /**
     * @var string
     */
    private $comments = '';

    /**
     * The constructor will configure the default invoice date to be the current date
     */
    public function __construct() {
        // Default to the current date for new invoices
        $this->invoiceDate = new \DateTime();
    }

    /**
     * Calculate the total of all developers' work without taxes
     * @return float
     */
    public function getInvoiceSubtotal() {
        // Check that developers were actually entered
        if (empty($this->developers) || !is_array($this->developers)) {
            return 0.0;
        }

        $total = 0.0;

        // To get the invoice total, sum up the billed hours for each developer and add tax based on given tax rate
        foreach ($this->developers as $developer) {
            if (!($developer instanceof DeveloperLineItem))
                continue;

            $total += $developer->getDeveloperTotalPrice();
        }

        return $total;
    }

    /**
     * Calculate the taxes for this invoice
     * @return float
     */
    public function getInvoiceTax() {
        if(!is_numeric($this->taxRate)) {
            return 0.0;
        }

        return round($this->taxRate * $this->getInvoiceSubtotal(), 2);
    }

    /**
     * Calculate this invoice's total
     * @return float
     */
    public function getInvoiceTotal()
    {
        return round($this->getInvoiceSubtotal() + $this->getInvoiceTax(), 2);
    }

    /**
     * @return \DateTime
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * @param \DateTime $invoiceDate
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
    }

    /**
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @param int $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param string $billingAddress
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return array
     */
    public function getDevelopers()
    {
        return $this->developers;
    }

    /**
     * @param array $developers
     */
    public function setDevelopers($developers)
    {
        $this->developers = $developers;
    }

    /**
     * @return int
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param int $taxRate
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
}