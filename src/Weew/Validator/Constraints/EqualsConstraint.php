<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value equals the given value.
 */
class EqualsConstraint implements IConstraint {
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var
     */
    protected $message;

    /**
     * EqualsConstraint constructor.
     *
     * @param $value
     * @param string $message
     */
    public function __construct($value, $message = null) {
        $this->value = $value;
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        return $value === $this->value;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return s('Must be equal to "%s".', $this->value);
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'value' => $this->value,
        ];
    }
}
