<?php

namespace Omnipay\BitPay\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * BitPay Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    public $endpoint = 'https://bitpay.com/api';

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getNotifyEmail()
    {
        return $this->getParameter('notifyEmail');
    }

    public function setNotifyEmail($value)
    {
        return $this->setParameter('notifyEmail', $value);
    }

    public function getFullNotifications()
    {
        return $this->getParameter('fullNotifications');
    }

    public function setFullNotifications($value)
    {
        return $this->setParameter('fullNotifications', $value);
    }

    public function getTransactionSpeed()
    {
        return $this->getParameter('transactionSpeed');
    }

    public function setTransactionSpeed($value)
    {
        return $this->setParameter('transactionSpeed', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function getItemCode()
    {
        return $this->getParameter('itemCode');
    }

    public function setItemCode($value)
    {
        return $this->setParameter('itemCode', $value);
    }

    public function getPhysical()
    {
        return $this->getParameter('physical');
    }

    public function setPhysical($value)
    {
        return $this->setParameter('physical', $value);
    }

    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = array();
        $data['price'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['posData'] = $this->getTransactionId();
        $data['itemDesc'] = $this->getDescription();
        $data['notificationURL'] = $this->getNotifyUrl();
        $data['redirectURL'] = $this->getReturnUrl();
        $data['notificationEmail'] = $this->getNotifyEmail();
        $data['fullNotifications'] = $this->getFullNotifications();
        $data['transactionSpeed'] = $this->getTransactionSpeed();
        $data['orderID'] = $this->getOrderId();
        $data['itemCode'] = $this->getItemCode();
        $data['physical'] = $this->getPhysical();
        $data['buyerName'] = $this->getCard()->getName();
        $data['buyerAddress1'] = $this->getCard()->getAddress1();
        $data['buyerAddress2'] = $this->getCard()->getAddress2();
        $data['buyerCity'] = $this->getCard()->getCity();
        $data['buyerState'] = $this->getCard()->getState();
        $data['buyerZip'] = $this->getCard()->getBillingPostcode();
        $data['buyerCountry'] = $this->getCard()->getCountry();
        $data['buyerEmail'] = $this->getCard()->getEmail();
        $data['buyerPhone'] = $this->getCard()->getPhone();

        return $data;
    }

    public function sendData($data)
    {
        $httpRequest = $this->httpClient->post($this->endpoint.'/invoice', null, $data);
        $httpResponse = $httpRequest
            ->setHeader('Authorization', 'Basic '.base64_encode($this->getApiKey().':'))
            ->send();

        return $this->response = new PurchaseResponse($this, $httpResponse->json());
    }
}
