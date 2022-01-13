<?php

namespace Localfr\UberallBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class validates and merges configuration from your app/config files.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/configuration.html
 */
class Configuration implements ConfigurationInterface
{
    public const ROOT = 'localfr_uberall';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(self::ROOT);
        $rootNode = method_exists($treeBuilder, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root(self::ROOT);

        $rootNode
            ->children()
                ->scalarNode('base_url')->isRequired()->end()
                ->scalarNode('private_key')->isRequired()->end()
            ->end();

        return $treeBuilder;
    }
}
