<?php

namespace Weew\Validator\PropertyAccessors;

use Weew\Validator\IPropertyAccessor;

class GetterPropertyAccessor implements IPropertyAccessor {
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
        $accessor = s('get%s', ucfirst($property));
        $callable = [$abstract, $accessor];

        if (is_callable($callable)) {
            return call_user_func($callable);
        }
    }
}
