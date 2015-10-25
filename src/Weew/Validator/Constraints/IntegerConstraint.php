<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is an integer.
 */
class IntegerConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_int($value);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
