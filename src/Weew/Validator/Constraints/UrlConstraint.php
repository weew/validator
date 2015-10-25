<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Checks if the value is a valid URL
 */
class UrlConstraint implements IConstraint {
    /**
     * Note, that any space characters in either the beginning or
     * the end of the string will result in a failure.
     *
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
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
