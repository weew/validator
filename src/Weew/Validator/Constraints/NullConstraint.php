<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is exactly null.
 */
class NullConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * NullConstraint constructor.
     *
     * @param string $message
     */
    public function __construct($message = null) {
        $this->message = $message;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_null($value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be null.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
