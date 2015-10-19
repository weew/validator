<?php

namespace Weew\Validator\PropertyAccessors;

use Weew\Validator\IPropertyAccessor;

class GetterPropertyAccessor implements IPropertyAccessor {
    /**
     * @param $abstract
     * @param $property
     *
     * @return bool
     */
    public function supports($abstract, $property) {
        if (is_object($abstract)) {
            return is_callable(
                [$abstract, $this->getPropertyAccessorName($property)]
            );
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
        return call_user_func(
            [$abstract, $this->getPropertyAccessorName($property)]
        );
    }

    /**
     * @param $property
     *
     * @return string
     */
    protected function getPropertyAccessorName($property) {
        return s('get%s', ucfirst($property));
    }
}
