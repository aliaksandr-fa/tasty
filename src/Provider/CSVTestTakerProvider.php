<?php

namespace Tasty\Provider;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Tasty\Entity\TestTaker;
use Tasty\Factory\TestTakerFactory;
use Tasty\Provider\Exception\InvalidDataException;
use Tasty\Provider\Exception\ProviderException;
use Tasty\Validator\TestTakerConstraint;


/**
 * Class CSVTestTakerProvider
 * @package Tasty\Provider
 * @author Faley Aliaksandr
 */
class CSVTestTakerProvider extends BaseTestTakerProvider implements TestTakerProviderInterface
{
    const FORMAT = 'csv';

    /**
     * @return TestTaker[]
     */
    public function load(): array
    {
        $lines = file($this->path);

        if (false === $lines) {
            throw new ProviderException(error_get_last()['message'] ?? 'Unknown error.');
        }

        $records = array_map('str_getcsv', $lines);

        array_walk($records, function (&$a) use ($records) {
            $a = array_combine(str_replace("\r", '', $records[0]), $a);
        });
        array_shift($records);


        return $this->parseData($records);
    }
}