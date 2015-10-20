<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is numeric (123 or '123').
 */
class NumericConstraint implements IConstraint {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
        return is_numeric($abstract);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
