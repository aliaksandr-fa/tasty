<?php

namespace Tasty\Controller;

use Tasty\Provider\ChainedTestTakerProvider;
use Tasty\Provider\TestTakerProviderInterface;


/**
 * Class TestTakersController
 * @package Tasty\Controller
 * @author Faley Aliaksandr
 */
class TestTakersController
{
    /**
     * @param ChainedTestTakerProvider $testTakerProvider
     * @return array
     */
    public function list(TestTakerProviderInterface $testTakerProvider): array
    {
        return $testTakerProvider->load();
    }
}