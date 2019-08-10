<?php


namespace Tasty\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Tasty\Provider\ChainedTestTakerProvider;

/**
 * Class ChainedTestTakerProviderCompilerPass
 * @package Tasty\DependencyInjection
 * @author Faley Aliaksandr
 */
class ChainedTestTakerProviderCompilerPass implements CompilerPassInterface
{
    const TEST_TAKER_PROVIDER_TAG = 'test_taker.provider';

    public function process(ContainerBuilder $container)
    {

        if (!$container->has(ChainedTestTakerProvider::class)) {
            return;
        }

        $definition = $container->findDefinition(ChainedTestTakerProvider::class);

        $taggedServices = $container->findTaggedServiceIds(self::TEST_TAKER_PROVIDER_TAG);


        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addProvider', [new Reference($id)]);
        }
    }
}