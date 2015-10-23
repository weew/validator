<?php

namespace Tests\Weew\Validator\Mocks;

use Exception;
use Weew\Validator\Validator;

class CustomValidator extends Validator {
    protected function configure() {
        throw new Exception('foo bar baz');
    }
}
