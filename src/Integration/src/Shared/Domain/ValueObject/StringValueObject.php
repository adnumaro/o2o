<?php

namespace O2O\Integration\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value() : string
    {
        return $this->value;
    }

    public function isEqual(self $other) : bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->value();
    }
}
