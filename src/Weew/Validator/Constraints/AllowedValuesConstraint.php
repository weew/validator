<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is in the list of allowed values.
 */
class AllowedValuesConstraint implements IConstraint {
    /**
     * @var array
     */
    protected $allowedValues;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param array $values
     * @param string $message
     */
    public function __construct(array $values, $message = null) {
        $this->allowedValues = $values;
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        return array_contains($this->allowedValues, $value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return s(
            'Is not allowed, allowed values are "%s".',
            implode(', ', $this->allowedValues)
        );
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'allowed_values' => $this->allowedValues,
        ];
    }
}
