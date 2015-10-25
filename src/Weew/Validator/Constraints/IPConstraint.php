<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a valid IP address.
 */
class IPConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
