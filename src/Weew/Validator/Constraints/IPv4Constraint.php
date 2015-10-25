<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a valid IP v4 address.
 */
class IPv4Constraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
