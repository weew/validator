<?php

namespace Weew\Validator\PropertyAccessors;

use Weew\Validator\IPropertyAccessor;

class ArrayPropertyAccessor implements IPropertyAccessor {
    /**
     * @param $abstract
     * @param $property
     *
     * @return bool
     */
    public function supports($abstract, $property) {
        return is_array($abstract) && array_has($abstract, $property);
    }

    /**
     * @param $abstract
     * @param $property
     *
     * @return mixed
     */
    public function getProperty($abstract, $property) {
        return array_get($abstract, $property);
    }
}
