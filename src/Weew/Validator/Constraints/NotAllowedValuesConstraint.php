<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

class NotAllowedValuesConstraint implements IConstraint {
    /**
     * @var array
     */
    protected $notAllowedValues;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param array $values
     * @param string $message
     */
    public function __construct(array $values, $message = null) {
        $this->notAllowedValues = $values;
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        return ! array_contains($this->notAllowedValues, $value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return s(
            'Is not allowed, forbidden values are "%s".',
            implode(', ', $this->notAllowedValues)
        );
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'not_allowed_values' => $this->notAllowedValues,
        ];
    }
}
