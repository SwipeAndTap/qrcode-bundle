# QRCodeBundle

This bundle aims for an easy Symfony2 and Twig integration for [QRCodes](http://en.wikipedia.org/wiki/QR_code).
It allows for multiple qr-implementations and different storage-solutions to store qr-code-configuration between requests.

## Current state

While most of the groundwork is done, the library is in pre-alpha state. There is only 1 renderer implementation
(for endroid/qrcode) and only a session-storage. Also tests and documentation are insufficient or even missing.

But it works in this specific configuration

## Examples ##

Assuming $container is the Symfony2 DIC:

    use Zikarsky\Bundle\QRCodeBundle as QR;

    $qrcodeService = $container->get('zikarsky_qrcode.service');
    $qrCode = new QR\QRCode('Test');

    /** @var $renderedQRCode QR\RenderedQRCode */
    $renderedQRCode = $qrCodeService->render($qrCode);

Or in a twig template:

    <img src="{{ qrcode("test", 150, "medium") }}" />






