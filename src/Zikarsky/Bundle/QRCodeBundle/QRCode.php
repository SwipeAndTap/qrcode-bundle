<?php

namespace Zikarsky\Bundle\QRCodeBundle;

class QRCode implements QRCodeInterface
{

    protected $contents;

    protected $size;

    protected $errorCorrectionLevel;

    public function __construct($contents, $size = null, $errorCorrectionLevel = null)
    {
        $this->contents = $contents;
        $this->size = intval($size);
        $this->errorCorrectionLevel = $errorCorrectionLevel;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getErrorCorrectionLevel()
    {
        return $this->errorCorrectionLevel;
    }

    public function __sleep()
    {
        return ['contents', 'size', 'errorCorrectionLevel'];
    }

}
