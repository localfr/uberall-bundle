<?php

namespace Localfr\UberallBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This class allows to load and manage the bundle configuration.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class LocalfrUberallExtension extends Extension
{
    public const EXTENSION_ALIAS = 'localfr_uberall';

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return self::EXTENSION_ALIAS;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('localfr_uberall.config.base_url', $config['base_url']);
        $container->setParameter('localfr_uberall.config.private_key', $config['private_key']);
    }
}
