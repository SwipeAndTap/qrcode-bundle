<?php

namespace Zikarsky\Bundle\QRCodeBundle;

/**
 * Class RenderedQRCode - a simple qrcode-rendering result
 *
 * @package Zikarsky\Bundle\QRCodeBundle
 */
class RenderedQRCode implements RenderedQRCodeInterface
{
    /**
     * @var QRCodeInterface
     */
    protected $qrCode;

    /**
     * @var string
     */
    protected $binary;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * Creates a RenderedQRCode
     *
     * @param QRCodeInterface $qrCode
     * @param string $binary
     * @param string $mimeType
     */
    public function __construct(QRCodeInterface $qrCode, $binary, $mimeType)
    {
        $this->qrCode = $qrCode;
        $this->binary = $binary;
        $this->mimeType = $mimeType;
    }

    /**
     * Returns the rendering result
     *
     * @return string
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * Returns the mime type
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Returns the QRCode which was rendered
     *
     * @return QRCodeInterface
     */
    public function getQrCode()
    {
        return $this->qrCode;
    }
}
