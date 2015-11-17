<?php

namespace Weew\Validator;

use Weew\Contracts\IArrayable;

interface IConstraint extends IArrayable {
    /**
     * @param $value
     *
     * @return bool
     */
    function check($value);
}
