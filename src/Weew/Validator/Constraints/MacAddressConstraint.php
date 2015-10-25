<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

class MacAddressConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return filter_var($value, FILTER_VALIDATE_MAC) !== false;
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
