<?php

namespace Weew\Validator\PropertyAccessors;

use Weew\Validator\IPropertyAccessor;

class ArrayPropertyAccessor implements IPropertyAccessor {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function supports($abstract) {
        return is_array($abstract);
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
