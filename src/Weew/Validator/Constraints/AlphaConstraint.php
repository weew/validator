<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value consists of alphabetical characters.
 */
class AlphaConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return preg_match('/^[[:alpha:]]$/u', $value) === 1;
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
