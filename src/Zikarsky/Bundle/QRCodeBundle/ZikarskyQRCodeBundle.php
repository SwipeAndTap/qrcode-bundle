<?php

namespace Zikarsky\Bundle\QRCodeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Zikarsky\Bundle\QRCodeBundle\DependencyInjection\ZikarskyQRCodeExtension;

class ZikarskyQRCodeBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getContainerExtension()
    {
        return new ZikarskyQRCodeExtension();
    }
}
