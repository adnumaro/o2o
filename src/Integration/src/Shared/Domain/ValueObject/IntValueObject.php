<?php

namespace O2O\Integration\Shared\Domain\ValueObject;

abstract class IntValueObject
{
    /**
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value() : int
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
        return (string) $this->value();
    }
}
