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

    /**
     * @return array
     */
    public function toArray() {
        return ['foo' => 'bar'];
    }
}
