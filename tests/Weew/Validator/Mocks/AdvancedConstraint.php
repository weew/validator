<?php

namespace Tests\Weew\Validator\Mocks;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

class AdvancedConstraint implements IConstraint {
    public function check($value, IValidationData $data = null) {
        throw new FakeValidationDataWrapperException($data);
    }

    public function getMessage() {
        return 'message';
    }

    public function getOptions() {
        return [];
    }
}
