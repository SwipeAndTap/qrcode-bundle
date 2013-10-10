<?php

namespace Zikarsky\Bundle\QRCodeBundle;

interface QRCodeInterface
{
    const ERROR_CORRECTION_LOW = "low";
    const ERROR_CORRECTION_MEDIUM = "medium";
    const ERROR_CORRECTION_QUARTILE = "quartile";
    const ERROR_CORRECTION_HIGH = "high";

    public function getContents();

    public function getSize();

    public function getErrorCorrectionLevel();

    public function __sleep();

}
