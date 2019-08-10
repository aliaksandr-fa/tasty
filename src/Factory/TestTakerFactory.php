<?php

namespace Tasty\Factory;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Tasty\Entity\TestTaker;

/**
 * Class TestTakerFactory
 * @package Tasty\Factory
 * @author Faley Aliaksandr
 */
class TestTakerFactory
{

    /**
     * @param array $state
     * @return TestTaker
     */
    public static function create(array $state = []): TestTaker
    {
        $testTaker = new TestTaker(
            $state['email'],
            $state['firstname'],
            $state['lastname']
        );

        $testTaker->setLogin($state['login'] ?? null);
        $testTaker->setPassword($state['password'] ?? null);
        $testTaker->setAddress($state['address'] ?? null);
        $testTaker->setGender($state['gender'] ?? null);
        $testTaker->setPicture($state['picture'] ?? null);
        $testTaker->setTitle($state['title'] ?? null);

        return $testTaker;
    }
}