<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\Tests;

use Dbp\Relay\BasePublicationBundle\DbpRelayBasePublicationBundle;
use Dbp\Relay\CoreBundle\TestUtils\CoreTestKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use CoreTestKernelTrait;

    protected function registerAdditionalBundles(): iterable
    {
        yield new DbpRelayBasePublicationBundle();
    }

    protected function configureAdditionalContainer(ContainerConfigurator $container): void
    {
        $container->extension('dbp_relay_base_publication', []);
    }
}
