<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a string.
 */
class StringConstraint implements IConstraint {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
        return is_string($abstract);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
