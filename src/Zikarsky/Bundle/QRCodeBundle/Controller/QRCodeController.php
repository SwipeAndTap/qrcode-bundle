<?php

namespace Zikarsky\Bundle\QRCodeBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Zikarsky\Bundle\QRCodeBundle\Service\QRCodeService;

class QRCodeController
{

    protected $qrCodeService;

    public function __construct(QRCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function displayAction($id)
    {
        $result = $this->qrCodeService->render($id);
        return new Response($result->getBinary(), 200, [
            'Content-Type' => $result->getMimeType()
        ]);
    }

}
