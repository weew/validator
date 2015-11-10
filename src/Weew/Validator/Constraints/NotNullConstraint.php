<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is not exactly null.
 */
class NotNullConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_null($value) === false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
