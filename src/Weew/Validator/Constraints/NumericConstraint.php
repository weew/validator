<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is numeric (123 or '123').
 */
class NumericConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_numeric($value);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
