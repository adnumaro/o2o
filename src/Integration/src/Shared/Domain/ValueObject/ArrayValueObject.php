<?php

declare(strict_types=1);

namespace O2O\Integration\Shared\Domain\ValueObject;

abstract class ArrayValueObject
{
    /**
     * @var array
     */
    protected $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function value() : array
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        $val = '';

        array_walk_recursive($this->value, function ($value) use (&$val) {
            $val = (string) $value . ' ';
        });

        return $val;
    }
}
