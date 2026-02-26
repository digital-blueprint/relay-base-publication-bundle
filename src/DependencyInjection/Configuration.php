<?php

declare(strict_types=1);

namespace Dbp\Relay\BasePublicationBundle\DependencyInjection;

use Dbp\Relay\CoreBundle\Authorization\AuthorizationConfigDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
use Dbp\Relay\CoreBundle\Rest\Rest;

class Configuration implements ConfigurationInterface
{
    public const ROLE_USER = 'ROLE_USER';

    private function getAuthorizationConfigNode(): NodeDefinition
    {
        return AuthorizationConfigDefinition::create()
            ->addRole(self::ROLE_USER, 'false', 'Returns true if the user is allowed to use the API.')
            ->getNodeDefinition();
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbp_relay_base_publication');

        /** @var \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        // append nodes to rootNode
        $rootNode->append(LocalData::getConfigNodeDefinition()); // Local data config
        $rootNode->append($this->getAuthorizationConfigNode());  // Authorization config
        //  REST config: $rootNode->append(Rest::getConfigNodeDefinition());

        return $treeBuilder;
    }
}
