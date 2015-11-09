<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value consists of alphabetical characters.
 * A character is considered as alphabetical if its a letter from current locale
 * Default is a-z A-Z
 * http://php.net/manual/en/function.setlocale.php
 */
class AlphaConstraint implements IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return ctype_alpha($value);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [];
    }
}
