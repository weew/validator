<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is valid email address.
 */
class EmailConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
        }
        return false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
