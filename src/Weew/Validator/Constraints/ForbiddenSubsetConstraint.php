<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check that elements within an array are not forbidden.
 */
class ForbiddenSubsetConstraint implements IConstraint {
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
        if (is_array($value)) {
            foreach ($value as $item) {
                if (array_contains($this->forbidden, $item)) {
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
            'Contains not allowed values, forbidden values are "%s".',
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
