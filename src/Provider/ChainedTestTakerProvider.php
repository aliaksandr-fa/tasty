<?php

namespace Tasty\Provider;

use Tasty\Entity\TestTaker;


/**
 * Class ChainedTestTakerProvider
 * @package Tasty\Provider
 * @author Faley Aliaksandr
 */
class ChainedTestTakerProvider implements TestTakerProviderInterface
{
    /**
     * @var TestTakerProviderInterface[]
     */
    protected $providers = [];

    /**
     * @return TestTaker[]
     */
    public function load(): array
    {
        $result = [];

        foreach ($this->providers as $provider) {
            $result = array_merge($result, $provider->load());
        }

        return $result;
    }


    public function addProvider(TestTakerProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }
}