<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a float.
 */
class FloatConstraint implements IConstraint {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
        return is_float($abstract);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
