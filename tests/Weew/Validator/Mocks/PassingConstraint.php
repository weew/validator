<?php

namespace Tests\Weew\Validator\Mocks;

use Weew\Validator\IConstraint;

class PassingConstraint implements IConstraint {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
        return true;;
    }

    /**
     * @return array
     */
    public function toArray() {
        return ['bar' => 'foo'];
    }
}
