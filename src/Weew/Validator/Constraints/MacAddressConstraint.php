<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

class MacAddressConstraint implements IConstraint {
    /**
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        if (is_string($string)) {
            return filter_var($string, FILTER_VALIDATE_MAC) !== false;
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
