<?php

namespace Tests\Weew\Validator\Mocks;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

class FailingConstraint implements IConstraint {
    /**
     * @param $abstract
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($abstract, IValidationData $data = null) {
        return false;
    }

    public function getMessage() {
        return 'failing';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return ['foo' => 'bar'];
    }
}
