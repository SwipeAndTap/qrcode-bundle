<?php

namespace Zikarsky\Bundle\QRCodeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zikarsky_qrcode')
            ->children()
                ->scalarNode('storage')
                    ->defaultValue('zikarsky_qrcode.storage.session')
                ->end()
                ->arrayNode('renderer')
                    ->children()
                        ->scalarNode('service')
                            ->defaultValue('zikarsky_qrcode.renderer.endroid')
                        ->end()
                        ->integerNode('default_size')->defaultValue(300)->end()
                        ->scalarNode('default_error_correction')->defaultValue(QRCodeInterface::ERROR_CORRECTION_MEDIUM)->end()
                        ->variableNode('default_options')
                            ->defaultValue([])
                            ->treatNullLike([])
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
