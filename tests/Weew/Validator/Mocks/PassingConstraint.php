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
