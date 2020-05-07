<?php

namespace GaylordP\EmailBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('email');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('from_email')
                    ->isRequired()
                ->end()
                ->scalarNode('from_name')
                    ->isRequired()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
