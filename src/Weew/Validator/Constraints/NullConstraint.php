<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is exactly null
 */
class NullConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_null($value);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
