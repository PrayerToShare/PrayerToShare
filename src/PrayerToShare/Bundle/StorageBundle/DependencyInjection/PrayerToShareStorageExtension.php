<?php

namespace PrayerToShare\Bundle\StorageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class PrayerToShareStorageExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('prayer_to_share_storage.amazon_s3.aws_key', $config['amazon_s3']['aws_key']);
        $container->setParameter('prayer_to_share_storage.amazon_s3.aws_secret_key', $config['amazon_s3']['aws_secret_key']);
        $container->setParameter('prayer_to_share_storage.amazon_s3.base_url', $config['amazon_s3']['aws_key']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
