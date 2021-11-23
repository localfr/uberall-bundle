<?php

namespace Localfr\UberallBundle\Tests;


use PHPUnit\Framework\TestCase;
use Localfr\UberallBundle\DependencyInjection\LocalfrUberallExtension;
use Localfr\UberallBundle\LocalfrUberallBundle;

class LocalfrUberallBundleTest extends TestCase
{
    public function testShouldReturnNewContainerExtension()
    {
        $testBundle = new LocalfrUberallBundle();

        $result = $testBundle->getContainerExtension();
        $this->assertInstanceOf(LocalfrUberallExtension::class, $result);
    }
}
