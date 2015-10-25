<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a float.
 */
class FloatConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_float($value);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
