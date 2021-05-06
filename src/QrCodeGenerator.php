<?php

namespace Junges\Pix;

use Junges\Pix\Contracts\GeneratesQrCodeContract;
use Mpdf\QrCode\Output\Png;
use Mpdf\QrCode\QrCode;

class QrCodeGenerator implements GeneratesQrCodeContract
{
    /**
     * @throws \Mpdf\QrCode\QrCodeException
     * @throws Exceptions\PixException
     */
    public function generateForPayload(Payload $payload)
    {
        $qrCode = new QrCode($payload->getPayload());

        $png = (new Png())->output($qrCode, config('laravel-pix.qr_code_size', 100));

        return base64_encode($png);
    }
}