<?php

namespace PDFFormBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testInvoice()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/invoice');

        $this->assertContains('Invoice date', $client->getResponse()->getContent());
    }
}
