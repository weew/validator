<?php

namespace Weew\Validator;

use Weew\Foundation\Interfaces\IArrayable;

interface IConstraint extends IArrayable {
    /**
     * @param $value
     *
     * @return bool
     */
    function check($value);
}
