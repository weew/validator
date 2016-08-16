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
    protected $expected;

    /**
     * @var
     */
    protected $message;

    /**
     * EqualsConstraint constructor.
     *
     * @param $expected
     * @param string $message
     */
    public function __construct($expected, $message = null) {
        $this->expected = $expected;
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        return $value === $this->expected;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return s('Must be equal to "%s".', $this->expected);
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'expected' => $this->expected,
        ];
    }
}
