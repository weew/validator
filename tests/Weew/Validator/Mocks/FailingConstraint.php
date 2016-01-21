<?php

namespace Tests\Weew\Validator\Mocks;

use Weew\Validator\IConstraint;

class FailingConstraint implements IConstraint {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
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
