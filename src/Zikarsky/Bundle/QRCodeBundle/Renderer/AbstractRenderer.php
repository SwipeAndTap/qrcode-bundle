<?php

namespace Zikarsky\Bundle\QRCodeBundle\Renderer;

use Zikarsky\Bundle\QRCodeBundle\QRCodeInterface;
use Zikarsky\Bundle\QRCodeBundle\RenderedQRCodeInterface;

abstract class AbstractRenderer implements RendererInterface
{
    const OPTION_ERROR_CORRECTION = "errorCorrection";
    const OPTION_SIZE = "size";

    /**
     * @var int
     */
    private $defaultSize = null;

    /**
     * @var string
     */
    private $defaultErrorCorrectionLevel = null;

    /**
     * @var array
     */
    private $defaultOptions = [];

    /**
     * Sets the rendering default-size
     *
     * @param $size
     */
    public function setDefaultSize($size)
    {
        $this->defaultSize = intval($size);
    }

    /**
     * Sets the default error-correction-level
     *
     * @param $errorCorrectionLevel
     */
    public function setDefaultErrorCorrectionLevel($errorCorrectionLevel)
    {
        $this->defaultErrorCorrectionLevel = $errorCorrectionLevel;
    }

    /**
     * Sets renderer-specific default options
     *
     * @param array $options
     */
    public function setDefaultOptions(array $options)
    {
        $this->defaultOptions = $options;
    }

    /**
     * @return int
     */
    public function getDefaultSize()
    {
        return $this->defaultSize;
    }

    /**
     * @return string
     */
    public function getDefaultErrorCorrectionLevel()
    {
        return $this->defaultErrorCorrectionLevel;
    }

    /**
     * @return array
     */
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    /**
     * @param QRCodeInterface $qrCode
     * @param array $options
     */
    protected function compileOptions(QRCodeInterface $qrCode, array $options)
    {
        $options = array_merge($this->getDefaultOptions(), $options);

        // size
        $size = $qrCode->getSize() ?: $this->getDefaultSize();
        if ($size) {
            $options[self::OPTION_SIZE] = $size;
        }

        // error-correction
        $errorCorrection = $qrCode->getErrorCorrectionLevel() ?: $this->getDefaultErrorCorrectionLevel();
        if ($errorCorrection) {
            $options[self::OPTION_ERROR_CORRECTION] = $errorCorrection;
        }

        return $options;
    }
}
