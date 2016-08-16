<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is not "empty" (not null, 0, false, '', or []).
 */
class NotEmptyConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * NotEmptyConstraint constructor.
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
        if (is_string($value)) {
            $value = trim($value);
        }

        return ! empty($value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must not be empty.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
