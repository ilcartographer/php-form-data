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
    private $name = '';
    private $description = '';
    private $hourlyPrice = 0;
    private $hours = 0;

    // TODO: Not sure if I want this here or not
    public function getDeveloperTotalPrice() {
        return round($this->hourlyPrice * $this->hours, 2);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getHourlyPrice()
    {
        return $this->hourlyPrice;
    }

    /**
     * @param mixed $hourlyPrice
     */
    public function setHourlyPrice($hourlyPrice)
    {
        $this->hourlyPrice = $hourlyPrice;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }


}