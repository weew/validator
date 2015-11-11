<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

class AlphaNumericConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_scalar($value)) {
            return preg_match('/^[[:alnum:]]+$/u', $value) === 1;
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
