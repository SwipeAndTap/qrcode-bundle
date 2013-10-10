<?php

namespace Zikarsky\Bundle\QRCodeBundle\Service;


use Zikarsky\Bundle\QRCodeBundle\QRCodeInterface;
use Zikarsky\Bundle\QRCodeBundle\RenderedQRCodeInterface;
use Zikarsky\Bundle\QRCodeBundle\Renderer\RendererInterface;
use Zikarsky\Bundle\QRCodeBundle\Storage\StorageInterface;
use RuntimeException;

class QRCodeService
{

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var RendererInterface
     */
    protected $renderer;

    public function __construct(StorageInterface $storage, RendererInterface $renderer)
    {
        $this->storage = $storage;
        $this->renderer = $renderer;
    }

    /**
     * Renders the QRCode with the given id and returns it
     *
     * @param $id
     * @param array $options
     * @return RenderedQRCodeInterface
     * @throws \RuntimeException
     */
    public function render($id, array $options = [])
    {
        $qrCode = $this->storage->load($id);
        if (!$qrCode) {
            throw new QRCodeNotFoundException("There is no QRCode with id $id");
        }

        return $this->renderer->render($qrCode, $options);
    }

    /**
     * Register a qr-code in the service
     *
     * @param QRCodeInterface $qrCode
     * @param string|null $id
     * @return string $id
     */
    public function register(QRCodeInterface $qrCode, $id = null)
    {
        return $this->storage->store($qrCode, $id);
    }
}
