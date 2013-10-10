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
        $options = $this->correctOptions($options);


        foreach ($options as $key => $value) {
            $method = "set" . ucfirst($key);
            if (!is_callable([$endroidQRCode, $method])) {
                throw new RuntimeException("Unsupported option $key");
            }

            $endroidQRCode->{$method}($value);
        }

        $endroidQRCode->setText($qrCode->getContents());

        $binary = $endroidQRCode->get(null);
        $mimeType = "image/" . $endroidQRCode->getImageType();

        return new RenderedQRCode($qrCode, $binary, $mimeType);
    }

    private function correctOptions(array $options)
    {
        $ec = self::OPTION_ERROR_CORRECTION;
        if (isset($options[$ec])) {

            switch ($options[$ec]) {
                case QRCodeInterface::ERROR_CORRECTION_LOW:
                    $options[$ec] = EndroidQRCode::LEVEL_LOW;
                    break;
                case QRCodeInterface::ERROR_CORRECTION_MEDIUM:
                    $options[$ec] = EndroidQRCode::LEVEL_MEDIUM;
                    break;
                case QRCodeInterface::ERROR_CORRECTION_HIGH:
                    $options[$ec] = EndroidQRCode::LEVEL_HIGH;
                    break;
                case QRCodeInterface::ERROR_CORRECTION_QUARTILE:
                    $options[$ec] = EndroidQRCode::LEVEL_QUARTILE;
                    break;
                default:
                    unset($options[$ec]);
                    break;

            }
        }

        return $options;
    }
}
