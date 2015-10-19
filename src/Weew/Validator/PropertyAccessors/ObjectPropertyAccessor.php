<?php

namespace Weew\Validator\PropertyAccessors;

use Weew\Validator\IPropertyAccessor;

class ObjectPropertyAccessor implements IPropertyAccessor {
    /**
     * @param $abstract
     * @param $property
     *
     * @return bool
     */
    public function supports($abstract, $property) {
        return is_object($abstract) && property_exists($abstract, $property);
    }

    /**
     * @param $abstract
     * @param $property
     *
     * @return mixed
     */
    public function getProperty($abstract, $property) {
        return $abstract->{$property};
    }
}
