<?php
/**
 * Created by IntelliJ IDEA.
 * User: mamiller
 * Date: 11/2/16
 * Time: 7:30 PM
 */

namespace PDFFormBundle\Tests\Model;


use PDFFormBundle\Model\DeveloperLineItem;

class DeveloperLineItemTest extends \PHPUnit_Framework_TestCase
{
    public function testDeveloperTotal() {
        $developer = new DeveloperLineItem();

        $developer->setHourlyPrice(3.1);
        $developer->setHours(2);

        $this->assertEquals(6.2, $developer->getDeveloperTotalPrice());
    }

    public function testDeveloperCharacterValues() {
        $developer = new DeveloperLineItem();

        $developer->setHourlyPrice('b');
        $developer->setHours(2);

        $this->assertEquals(0, $developer->getDeveloperTotalPrice());
    }

    public function testDeveloperTotalZeroHours() {
        $developer = new DeveloperLineItem();

        $developer->setHours(2);

        $this->assertEquals(0, $developer->getDeveloperTotalPrice());
    }

    public function testDeveloperTotalZeroRate() {$developer = new DeveloperLineItem();

        $developer->setHours(2);

        $this->assertEquals(0, $developer->getDeveloperTotalPrice());
    }
}