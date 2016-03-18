<?php

namespace Garethellis\HamcrestMatchers\Matcher;

use Hamcrest\BaseMatcher;
use Hamcrest\Description;

class ArrayValuesMatcher extends BaseMatcher
{
    /**
     * @var array|\Traversable
     */
    private $expected;

    /**
     * ArrayValuesMatcher constructor.
     * @param \Traversable|array $array
     */
    public function __construct($array)
    {
        $this->assertArrayLike($array);
        $this->expected = $array;
    }

    public function matches($actual)
    {
        $this->assertArraylike($actual);
        return $this->getValues($actual) === $this->getValues($this->expected);
    }

    public function describeTo(Description $description)
    {
        $description->appendValue($this->expected);
    }

    protected function getValues($arrayLike)
    {
        if ($arrayLike instanceof \Traversable) {
            $arrayLike = iterator_to_array($arrayLike);
        }
        return array_values($arrayLike);
    }

    protected function assertArrayLike($array)
    {
        if (!is_array($array) && !$array instanceof \Traversable) {
            throw new \InvalidArgumentException(
                "Argument passed to ArrayValuesMatcher must be an array or an instance of Traversable"
            );
        }
    }
}
