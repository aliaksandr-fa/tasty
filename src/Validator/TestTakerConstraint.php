<?php

namespace Tasty\Validator;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Url;
use Tasty\Entity\TestTaker;


/**
 * Class TestTakerConstraint
 * @package Tasty\Validator
 * @author Faley Aliaksandr
 */
class TestTakerConstraint extends Collection
{
    public function __construct($options = null)
    {
        parent::__construct(array_merge([

            "login" => new Optional(),
            "password" => new Optional(),
            "title" => new Choice(TestTaker::$titles),
            "lastname" => new NotBlank(),
            "firstname" => new NotBlank(),
            "gender" => new Choice(TestTaker::$genders),
            "email" => new Email(),
            "picture" => new Optional([new Url()]),
            "address" => new Optional()

        ], $options ?? []));
    }

    public function validatedBy()
    {
        return Collection::class.'Validator';
    }
}