<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is valid email address.
 */
class EmailConstraint implements IConstraint {
    /**
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        if (is_string($string)) {
            return filter_var($string, FILTER_VALIDATE_EMAIL) !== false;
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
