<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is accepted.
 */
class AcceptedConstraint implements IConstraint {
    /**
     * @var array
     */
    protected $validValues = ['yes', 'on', '1', 'true', 1, true];

    /**
     * @var string
     */
    protected $message;

    /**
     * AcceptedConstraint constructor.
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
        return in_array($value, $this->validValues, true);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be accepted.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'valid_values' => $this->validValues,
        ];
    }
}
