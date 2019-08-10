<?php

namespace Tasty\Provider;

use Tasty\Entity\TestTaker;
use Tasty\Provider\Exception\ProviderException;

/**
 * Class JSONTestTakerProvider
 * @package Tasty\Provider
 * @author Faley Aliaksandr
 */
class JSONTestTakerProvider extends BaseTestTakerProvider implements TestTakerProviderInterface
{
    const FORMAT = 'json';

    /**
     * @return TestTaker[]
     */
    public function load(): array
    {
        $content = file_get_contents($this->path);

        if (false === $content) {
            throw new ProviderException(error_get_last()['message'] ?? 'Unknown error.');
        }

        $records = json_decode($content, true);

        return $this->parseData($records);
    }
}