<?php

namespace Weew\Validator\PropertyAccessors;

use Weew\Validator\IPropertyAccessor;

class ObjectPropertyAccessor implements IPropertyAccessor {
    /**
     * @param $abstract
     *
     * @return bool
     */
    public function supports($abstract) {
        return is_object($abstract);
    }

    /**
     * @param $abstract
     * @param $property
     *
     * @return mixed
     */
    public function getProperty($abstract, $property) {
        if (property_exists($abstract, $property)) {
            return $abstract->{$property};
        }
    }
}
