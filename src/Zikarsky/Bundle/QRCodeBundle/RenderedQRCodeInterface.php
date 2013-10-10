<?php

namespace Zikarsky\Bundle\QRCodeBundle;

interface RenderedQRCodeInterface
{
    /**
     * @return string
     */
    public function getBinary();

    /**
     * @return string
     */
    public function getMimeType();

    /**
     * @return QRCodeInterface
     */
    public function getQrCode();
}
