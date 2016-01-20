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
    protected $min;

    /**
     * @var int
     */
    protected $max;

    /**
     * @param $min
     * @param $max
     */
    public function __construct($min, $max) {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            $length = strlen($value);

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
