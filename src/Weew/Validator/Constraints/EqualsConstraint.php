<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value equals the given value.
 */
class EqualsConstraint implements IConstraint {
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param $value
     */
    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return $value === $this->value;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'value' => $this->value,
        ];
    }
}
