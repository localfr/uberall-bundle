<?php

namespace Localfr\UberallBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Localfr\UberallBundle\DependencyInjection\LocalfrUberallExtension;

class LocalfrUberallBundle extends Bundle
{
    /**
     * Overridden to allow for the custom extension alias.
     *
     * @return LocalfrUberallExtension
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new LocalfrUberallExtension();
        }

        return $this->extension;
    }
}
