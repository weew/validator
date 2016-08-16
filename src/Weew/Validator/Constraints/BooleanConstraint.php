<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is a boolean.
 */
class BooleanConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * BooleanConstraint constructor.
     *
     * @param string $message
     */
    public function __construct($message = null) {
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        return is_bool($value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be a boolean.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
