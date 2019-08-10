<?php

namespace Tasty\Provider;

use Tasty\Entity\TestTaker;


/**
 * Interface TestTakerProviderInterface
 * @package Tasty\Provider
 * @author Faley Aliaksandr
 */
interface TestTakerProviderInterface
{
    /**
     * @return TestTaker[]
     */
    public function load(): array;
}