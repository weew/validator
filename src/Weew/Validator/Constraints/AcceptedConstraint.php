<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is accepted.
 */
class AcceptedConstraint implements IConstraint {
    /**
     * @var array
     */
    protected $validValues = ['yes', 'on', '1', 'true', 1, true];

    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
        return in_array($abstract, $this->validValues, true);
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'valid_values' => $this->validValues,
        ];
    }
}
