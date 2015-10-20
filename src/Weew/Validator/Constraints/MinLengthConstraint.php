<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value has the given min length.
 */
class MinLengthConstraint implements IConstraint {
    /**
     * @var int
     */
    private $min;

    /**
     * @param $min
     */
    public function __construct($min) {
        $this->min = $min;
    }

    /**
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        if (is_string($string)) {
            return strlen($string) >= $this->min;
        }

        return false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'min' => $this->min,
        ];
    }
}
