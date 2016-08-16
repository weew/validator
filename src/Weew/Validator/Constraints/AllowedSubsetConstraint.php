<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check that elements within array are allowed.
 */
class AllowedSubsetConstraint implements IConstraint {
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
        if (is_array($value)) {
            foreach ($value as $item) {
                if ( ! array_contains($this->allowed, $item)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return s(
            'Contains not allowed values, allowed values are "%s".',
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
