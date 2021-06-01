<?php

namespace App\Payment\PagSeguro;

class Boleto
{
    private $items;
    private $user;
    private $reference;
    private $shipping;
    private $senderHash;

    public function __construct($items, $user, $reference, $shipping, $senderHash)
    {
        $this->items = $items;
        $this->user = $user;
        $this->reference = $reference;
        $this->shipping = $shipping;
        $this->senderHash = $senderHash;
    }

    public function doPayment()
    {
        $boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();


        $boleto->setMode('DEFAULT');

        $boleto->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $boleto->setCurrency("BRL");


        foreach ($this->items as $item) {
            $boleto->addItems()->withParameters(
                $item['id'],
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        list($shipCode, $shipPrice, $shipDeadline) = explode("|", $this->shipping);

        $boleto->addItems()->withParameters(
            $shipCode . '_ship',
            'Shipping',
            1,
            floatval($shipPrice)
        );


        $boleto->setReference(base64_encode($this->reference));


        //$boleto->setExtraAmount(11.5);

        $user = $this->user;
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'text@sandbox.pagseguro.com.br' : $user->email;
        $boleto->setSender()->setName($user->name);
        $boleto->setSender()->setEmail($email);

        $boleto->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $boleto->setSender()->setDocument()->withParameters(
            'CPF',
            '32698095067'
        );

        $boleto->setSender()->setHash($this->senderHash);

        $boleto->setSender()->setIp('127.0.0.0');


        $boleto->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $result = $boleto->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );
        return $result;
    }
}
