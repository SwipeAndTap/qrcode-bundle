<?php

namespace Zikarsky\Bundle\QRCodeBundle\Renderer;

use Zikarsky\Bundle\QRCodeBundle\QRCodeInterface;
use Zikarsky\Bundle\QRCodeBundle\RenderedQRCodeInterface;

interface RendererInterface
{
    /**
     * Renders a QRCode
     *
     * @param QRCodeInterface $qrCode
     * @param array $options
     * @return RenderedQRCodeInterface
     */
    public function render(QRCodeInterface $qrCode, array $options = []);

    /**
     * Sets the rendering default-size
     *
     * @param $size
     */
    public function setDefaultSize($size);

    /**
     * Sets the default error-correction-level
     *
     * @param $errorCorrectionLevel
     */
    public function setDefaultErrorCorrectionLevel($errorCorrectionLevel);

    /**
     * Sets renderer specific default options
     *
     * @param array $options
     */
    public function setDefaultOptions(array $options);

}
