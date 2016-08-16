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
    protected $allowed;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param array $allowed
     * @param string $message
     */
    public function __construct(array $allowed, $message = null) {
        $this->allowed = $allowed;
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        return array_contains($this->allowed, $value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return s(
            'Invalid value, allowed values are "%s".',
            implode(', ', $this->allowed)
        );
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'allowed' => $this->allowed,
        ];
    }
}
