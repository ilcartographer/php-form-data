<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/1/16
 * Time: 8:28 PM
 */

namespace PDFFormBundle\Model;


class DeveloperLineItem
{
    private $name;
    private $description;
    private $hourlyPrice;
    private $hours;

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