<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is an integer.
 */
class IntegerConstraint implements IConstraint {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
        return is_int($abstract);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
