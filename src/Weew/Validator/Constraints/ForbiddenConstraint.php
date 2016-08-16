<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is not in the list of forbidden values.
 */
class ForbiddenConstraint implements IConstraint {
    /**
     * @var array
     */
    protected $forbidden;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param array $forbidden
     * @param string $message
     */
    public function __construct(array $forbidden, $message = null) {
        $this->forbidden = $forbidden;
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        return ! array_contains($this->forbidden, $value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return s(
            'Invalid value, forbidden values are "%s".',
            implode(', ', $this->forbidden)
        );
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'forbidden' => $this->forbidden,
        ];
    }
}
