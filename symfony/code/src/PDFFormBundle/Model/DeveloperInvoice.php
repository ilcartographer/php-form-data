<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/1/16
 * Time: 8:28 PM
 */

namespace PDFFormBundle\Model;


class DeveloperInvoice
{
    private $invoiceDate;
    private $invoiceId;
    private $customerId;
    private $billingAddress;
    private $developers;
    private $taxRate;
    private $comments;

    /**
     * @return float
     */
    public function calculateInvoiceTotal() {
        // Check that developers were actually entered
        if(empty($this->developers) || !is_array($this->developers)) {
            return 0.0;
        }

        $total = 0.0;

        // To get the invoice total, sum up the billed hours for each developer and add tax based on given tax rate
        foreach($this->developers as $developer) {
            if(!($developer instanceof DeveloperLineItem))
                continue;

            $total += $developer->getHourlyPrice() * $developer->getHours();
        }

        return $total + ($total * $this->taxRate);
    }

    /**
     * @return mixed
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * @param mixed $invoiceDate
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @param mixed $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return mixed
     */
    public function getDevelopers()
    {
        return $this->developers;
    }

    /**
     * @param mixed $developers
     */
    public function setDevelopers($developers)
    {
        $this->developers = $developers;
    }

    /**
     * @return mixed
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param mixed $taxRate
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }



}