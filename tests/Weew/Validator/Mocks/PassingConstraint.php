<?php

namespace Tests\Weew\Validator\Mocks;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

class PassingConstraint implements IConstraint {
    /**
     * @param $abstract
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($abstract, IValidationData $data = null) {
        return true;;
    }

    public function getMessage() {
        return 'passing';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return ['bar' => 'foo'];
    }
}
