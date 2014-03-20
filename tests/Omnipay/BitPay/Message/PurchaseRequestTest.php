<?php

namespace Omnipay\BitPay\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'amount' => '12.00',
                'currency' => 'AUD',
                'transactionId' => '5',
                'description' => 'thing',
                'notifyUrl' => 'https://www.example.com/notify',
                'returnUrl' => 'https://www.example.com/return',
                'notifyEmail' => 'merchant@example.com',
                'fullNotifications' => false,
                'transactionSpeed' => 'medium',
                'orderId' => '5',
                'itemCode' => '123-11-123',
                'physical' => false,
                'buyerName' => 'John Doe',
                'buyerAddress1' => 'Address Line 1',
                'buyerAddress2' => 'Address Line 2',
                'buyerCity' => 'Bitcoin City',
                'buyerState' => 'Bitcoinaho',
                'buyerZip' => 'SAMPLE-ZIP',
                'buyerCountry' => 'Bitcoin Islands',
                'buyerEmail' => 'buyer@example.com',
                'buyerPhone' => '00-00000000',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('12.00', $data['price']);
        $this->assertSame('AUD', $data['currency']);
        $this->assertSame('5', $data['posData']);
        $this->assertSame('thing', $data['itemDesc']);
        $this->assertSame('https://www.example.com/notify', $data['notificationURL']);
        $this->assertSame('https://www.example.com/return', $data['redirectURL']);
        $this->assertSame('merchant@example.com', $data['notificationEmail']);
        $this->assertFalse($data['fullNotifications']);
        $this->assertSame('medium', $data['transactionSpeed']);
        $this->assertSame('5', $data['orderID']);
        $this->assertSame('123-11-123', $data['itemCode']);
        $this->assertFalse($data['physical']);
        $this->assertSame('John Doe', $data['buyerName']);
        $this->assertSame('Address Line 1', $data['buyerAddress1']);
        $this->assertSame('Address Line 2', $data['buyerAddress2']);
        $this->assertSame('Bitcoin City', $data['buyerCity']);
        $this->assertSame('Bitcoinaho', $data['buyerState']);
        $this->assertSame('SAMPLE-ZIP', $data['buyerZip']);
        $this->assertSame('Bitcoin Islands', $data['buyerCountry']);
        $this->assertSame('buyer@example.com', $data['buyerEmail']);
        $this->assertSame('00-00000000', $data['buyerPhone']);
    }

    public function testSend()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
    }
}
