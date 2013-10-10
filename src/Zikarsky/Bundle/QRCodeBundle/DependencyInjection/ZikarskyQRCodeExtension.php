<?php

namespace Zikarsky\Bundle\QRCodeBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class ZikarskyQRCodeExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setAlias("zikarsky_qrcode.storage", $config["storage"]);
        $container->setAlias("zikarsky_qrcode.renderer", $config["renderer"]["service"]);

        $rendererDefinition = $container->getDefinition($config["renderer"]["service"]);
        $rendererDefinition->addMethodCall("setDefaultSize", [$config["renderer"]["default_size"]]);
        $rendererDefinition->addMethodCall("setDefaultErrorCorrectionLevel", [$config["renderer"]["default_error_correction"]]);
        $rendererDefinition->addMethodCall("setDefaultOptions", [$config["renderer"]["default_options"]]);


    }

    /**
     * {@inheritDoc}
     *
     * @codeCoverageIgnore
     */
    public function getAlias()
    {
        return "zikarsky_qrcode";
    }

}
