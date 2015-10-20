<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value's length is in the given range.
 */
class LengthRangeConstraint implements IConstraint {
    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    /**
     * @param $min
     * @param $max
     */
    public function __construct($min, $max) {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        if (is_string($string)) {
            $length = strlen($string);

            return $length >= $this->min && $length <= $this->max;
        }

        return false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'min' => $this->min,
            'max' => $this->max,
        ];
    }
}
