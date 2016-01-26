<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is not exactly null.
 */
class NotNullConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * NotNullConstraint constructor.
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
        return is_null($value) === false;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must not be null.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
