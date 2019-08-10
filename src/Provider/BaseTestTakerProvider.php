<?php


namespace Tasty\Provider;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Tasty\Entity\TestTaker;
use Tasty\Factory\TestTakerFactory;
use Tasty\Provider\Exception\InvalidDataException;
use Tasty\Validator\TestTakerConstraint;


/**
 * Class BaseTestTakerProvider
 *
 * @package Tasty\Provider
 * @author Faley Aliaksandr
 */
class BaseTestTakerProvider
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * AbstractTestTakerProvider constructor.
     * @param string $path
     * @param ValidatorInterface $validator
     */
    public function __construct(string $path, ValidatorInterface $validator)
    {
        $this->path = $path;
        $this->validator = $validator;
    }

    /**
     * @param array $records
     * @return TestTaker[]
     */
    protected function parseData(array $records = []): array {

        $testTakers = [];

        foreach ($records as $record) {

            $this->validateTakerData($record);

            $testTakers[] = TestTakerFactory::create($record);
        }

        return $testTakers;
    }

    /**
     * @param array $takerData
     */
    protected function validateTakerData(array $takerData): void
    {
        $violations = $this->validator->validate($takerData, new TestTakerConstraint());

        if ($violations->count() > 0) {
            throw new InvalidDataException($violations->get(0)->getMessage());
        }
    }
}