<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is in the list of allowed values.
 */
class AllowedConstraint implements IConstraint {
    /**
     * @var array
     */
    protected $validValues;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param array $values
     * @param string $message
     */
    public function __construct(array $values, $message = null) {
        $this->validValues = $values;
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

        return 'Is not allowed.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'allowed_values' => $this->validValues,
        ];
    }
}
