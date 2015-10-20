<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a valid IP address.
 */
class IPConstraint implements IConstraint {
    /**
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        return filter_var($string, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
