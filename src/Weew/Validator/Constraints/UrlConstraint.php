<?php


namespace Weew\Validator\Constraints;


use Weew\Validator\IConstraint;

/**
 * Checks if the value is a valid URL
 */
class UrlConstraint implements IConstraint {

    /**
     *
     * Note, that any space characters in either the beginning or
     * the end of the string will result in a failure.
     *
     * @param $abstract
     *
     * @return bool
     */
    function check($abstract) {
        if (is_string($abstract)) {
            return filter_var($abstract, FILTER_VALIDATE_URL) !== false;
        }

        return false;
    }

    /**
     * @return array
     */
    function toArray() {
        return [];
    }
}