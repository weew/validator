<?php

namespace Weew\Validator\PropertyAccessors;

use ReflectionObject;
use ReflectionProperty;
use Weew\Validator\IPropertyAccessor;

class ObjectPropertyAccessor implements IPropertyAccessor {
    /**
     * @param $abstract
     * @param $property
     *
     * @return bool
     */
    public function supports($abstract, $property) {

        if (is_object($abstract)) {
            $classReflector = new ReflectionObject($abstract);

            if ($classReflector->hasProperty($property)) {
                $propertyReflector = new ReflectionProperty($abstract, $property);

                return $propertyReflector->isPublic();
            }
        }

        return false;
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
