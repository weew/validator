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
    private $max;

    /**
     * @param $max
     */
    public function __construct($max) {
        $this->max = $max;
    }

    /**
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        if (is_string($string)) {
            return strlen($string) <= $this->max;
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
