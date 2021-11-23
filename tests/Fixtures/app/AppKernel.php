<?php

namespace Localfr\UberallBundle\Tests\Fixtures\app;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;
use Localfr\UberallBundle\LocalfrUberallBundle;

class AppKernel extends Kernel
{
    public function __construct($env, $debug)
    {
        parent::__construct($env, $debug);

        (new Filesystem())->remove($this->getCacheDir());
    }

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new LocalfrUberallBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config.yaml');
        $loader->load($this->getRootDir() . '/config/localfr_uberall.yaml');
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return '/tmp/symfony-cache';
    }

    public function getLogDir()
    {
        return '/tmp/symfony-cache';
    } 
}
