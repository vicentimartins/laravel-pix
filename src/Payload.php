<?php

namespace Junges\Pix;

use Junges\Pix\Concerns\InteractsWithPayload;
use Junges\Pix\Concerns\ValidatePixKeys;
use Junges\Pix\Concerns\VerifiesCr16;
use Junges\Pix\Contracts\KeyValidations\ValidateCnpjKeyContract;
use Junges\Pix\Contracts\KeyValidations\ValidateCPFKeyContract;
use Junges\Pix\Contracts\KeyValidations\ValidateEmailKeysContract;
use Junges\Pix\Contracts\KeyValidations\ValidateRandomPixKeysContract;
use Junges\Pix\Contracts\PixPayloadContract;

class Payload implements PixPayloadContract,
    ValidateRandomPixKeysContract,
    ValidateCnpjKeyContract,
    ValidateCPFKeyContract,
    ValidateEmailKeysContract
{
    use InteractsWithPayload;
    use VerifiesCr16;
    use ValidatePixKeys;

    const PAYLOAD_FORMAT_INDICATOR = '00';
    const MERCHANT_ACCOUNT_INFORMATION = '26';
    const MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
    const MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
    const MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
    const MERCHANT_CATEGORY_CODE = '52';
    const TRANSACTION_CURRENCY = '53';
    const TRANSACTION_AMOUNT = '54';
    const COUNTRY_CODE = '58';
    const MERCHANT_NAME = '59';
    const MERCHANT_CITY = '60';
    const ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
    const ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
    const CRC16 = '63';

    private string $pixKey;
    private string $description;
    private string $merchantName;
    private string $merchantCity;
    private string $transaction_id;
    private string $amount;

    public function pixKey(string $pixKey): Payload
    {
        $this->pixKey = $pixKey;

        return $this;
    }

    public function description(string $description): Payload
    {
        $this->description = $description;

        return $this;
    }

    public function merchantName(string $merchantName): Payload
    {
        $this->merchantName = $merchantName;

        return $this;
    }

    public function transactionId(string $transaction_id): Payload
    {
        $this->transaction_id = $transaction_id;

        return $this;
    }

    public function amount(string $amount): Payload
    {
        $this->amount = $amount;

        return $this;
    }

    public function merchantCity(string $merchantCity): Payload
    {
        $this->merchantCity = $merchantCity;
        return $this;
    }

    public function payload(): string
    {
        return $this->formatValue(self::PAYLOAD_FORMAT_INDICATOR, '01');
    }
}