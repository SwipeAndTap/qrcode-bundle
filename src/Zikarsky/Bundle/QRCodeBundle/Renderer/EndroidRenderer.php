<?php

namespace Zikarsky\Bundle\QRCodeBundle\Renderer;

use Zikarsky\Bundle\QRCodeBundle\QRCodeInterface;
use Zikarsky\Bundle\QRCodeBundle\RenderedQRCode;
use Zikarsky\Bundle\QRCodeBundle\RenderedQRCodeInterface;
use Endroid\QrCode\QrCode as EndroidQRCode;
use RuntimeException;

class EndroidRenderer extends AbstractRenderer implements RendererInterface
{
    /**
     * Renders a QRCode
     *
     * @param QRCodeInterface $qrCode
     * @param array $options
     * @return RenderedQRCodeInterface
     */
    public function render(QRCodeInterface $qrCode, array $options = [])
    {

        $endroidQRCode = new EndroidQRCode();
        $options = $this->compileOptions($qrCode, $options);

        foreach ($options as $key => $value) {
            $method = "set" . ucfirst($key);
            if (!is_callable([$endroidQRCode, $method])) {
                throw new RuntimeException("Unsupported option $key");
            }

            $endroidQRCode->{$method}($value);
        }

        $binary = $endroidQRCode->create(null);
        $mimeType = "image/" . $endroidQRCode->getImageType();

        return new RenderedQRCode($qrCode, $binary, $mimeType);
    }
}
