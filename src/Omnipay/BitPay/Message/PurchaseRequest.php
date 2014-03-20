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

    public function getBuyerName()
    {
        return $this->getParameter('buyerName');
    }

    public function setBuyerName($value)
    {
        return $this->setParameter('buyerName', $value);
    }

    public function getBuyerAddress1()
    {
        return $this->getParameter('buyerAddress1');
    }

    public function setBuyerAddress1($value)
    {
        return $this->setParameter('buyerAddress1', $value);
    }

    public function getBuyerAddress2()
    {
        return $this->getParameter('buyerAddress2');
    }

    public function setBuyerAddress2($value)
    {
        return $this->setParameter('buyerAddress2', $value);
    }

    public function getBuyerCity()
    {
        return $this->getParameter('buyerCity');
    }

    public function setBuyerCity($value)
    {
        return $this->setParameter('buyerCity', $value);
    }

    public function getBuyerState()
    {
        return $this->getParameter('buyerState');
    }

    public function setBuyerState($value)
    {
        return $this->setParameter('buyerState', $value);
    }

    public function getBuyerZip()
    {
        return $this->getParameter('buyerZip');
    }

    public function setBuyerZip($value)
    {
        return $this->setParameter('buyerZip', $value);
    }

    public function getBuyerCountry()
    {
        return $this->getParameter('buyerCountry');
    }

    public function setBuyerCountry($value)
    {
        return $this->setParameter('buyerCountry', $value);
    }

    public function getBuyerEmail()
    {
        return $this->getParameter('buyerEmail');
    }

    public function setBuyerEmail($value)
    {
        return $this->setParameter('buyerEmail', $value);
    }

    public function getBuyerPhone()
    {
        return $this->getParameter('buyerPhone');
    }

    public function setBuyerPhone($value)
    {
        return $this->setParameter('buyerPhone', $value);
    }

    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = array(
            'price' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'posData' => $this->getTransactionId(),
            'itemDesc' => $this->getDescription(),
            'notificationURL' => $this->getNotifyUrl(),
            'redirectURL' => $this->getReturnUrl(),
            'notificationEmail' => $this->getNotifyEmail(),
            'fullNotifications' => $this->getFullNotifications(),
            'transactionSpeed' => $this->getTransactionSpeed(),
            'orderID' => $this->getOrderId(),
            'itemCode' => $this->getItemCode(),
            'physical' => $this->getPhysical(),
            'buyerName' => $this->getBuyerName(),
            'buyerAddress1' => $this->getBuyerAddress1(),
            'buyerAddress2' => $this->getBuyerAddress2(),
            'buyerCity' => $this->getBuyerCity(),
            'buyerState' => $this->getBuyerState(),
            'buyerZip' => $this->getBuyerZip(),
            'buyerCountry' => $this->getBuyerCountry(),
            'buyerEmail' => $this->getBuyerEmail(),
            'buyerPhone' => $this->getBuyerPhone(),
        );

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
