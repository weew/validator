<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

class AllowedConstraint implements IConstraint {
    /**
     * @var array
     */
    protected $validValues;

    /**
     * @param $values
     */
    public function __construct($values) {
        if ( ! is_array($values)) {
            $values = func_get_args();
        }

        $this->validValues = $values;
    }

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
