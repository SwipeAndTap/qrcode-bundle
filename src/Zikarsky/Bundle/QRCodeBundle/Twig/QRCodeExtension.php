<?php

namespace Zikarsky\Bundle\QRCodeBundle\Twig;

use Symfony\Component\Routing\RouterInterface;
use Zikarsky\Bundle\QRCodeBundle\QRCode;
use Zikarsky\Bundle\QRCodeBundle\Service\QRCodeService;

class QRCodeExtension extends \Twig_Extension
{
    /**
     * @var QRCodeService
     */
    private $qrCodeService;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(QRCodeService $qrCodeService, RouterInterface $router)
    {
        $this->qrCodeService = $qrCodeService;
        $this->router = $router;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('qrcode', [$this, 'qrcode'])
        ];
    }

    public function qrcode($contents, $size = null, $errorCorrection = null)
    {
        $qrCode = new QRCode($contents, $size, $errorCorrection);
        $id = $this->qrCodeService->register($qrCode);
        return $this->router->generate('zikarsky_qrcode_display', ["id" => $id]);
    }


    public function getName()
    {
        return 'zikarsky_qrcode';
    }


}
