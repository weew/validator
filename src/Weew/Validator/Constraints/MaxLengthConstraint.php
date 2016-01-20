<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value has the given max length.
 */
class MaxLengthConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $max;

    /**
     * @param $max
     */
    public function __construct($max) {
        $this->max = $max;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return strlen($value) <= $this->max;
        }

        return false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'max' => $this->max
        ];
    }
}
