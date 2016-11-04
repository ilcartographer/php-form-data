<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/1/16
 * Time: 8:28 PM
 */

namespace PdfFormBundle\Model;


class DeveloperLineItem
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var float
     */
    private $hourlyPrice = 0;

    /**
     * @var float
     */
    private $hours = 0;

    /**
     * Return the total to charge for this developer's work
     * @return float
     */
    public function getDeveloperTotalPrice() {
        return round($this->hourlyPrice * $this->hours, 2);
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getHourlyPrice()
    {
        return $this->hourlyPrice;
    }

    /**
     * @param float $hourlyPrice
     */
    public function setHourlyPrice($hourlyPrice)
    {
        $this->hourlyPrice = $hourlyPrice;
    }

    /**
     * @return float
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param float $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }
}