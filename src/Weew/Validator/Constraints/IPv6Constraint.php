<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a valid IP v6 address.
 */
class IPv6Constraint implements IConstraint {
    /**
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        return filter_var($string, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
