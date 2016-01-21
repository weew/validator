<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Checks if the value is a valid URL
 */
class UrlConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * UrlConstraint constructor.
     *
     * @param string $message
     */
    public function __construct($message = null) {
        $this->message = $message;
    }

    /**
     * Note, that any space characters in either the beginning or
     * the end of the string will result in a failure.
     *
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be a url.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
