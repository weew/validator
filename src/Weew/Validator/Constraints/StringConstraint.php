<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a string.
 */
class StringConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_string($value);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
