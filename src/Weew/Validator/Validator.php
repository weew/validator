<?php

namespace Weew\Validator;

use Weew\Validator\PropertyAccessors\ArrayPropertyAccessor;
use Weew\Validator\PropertyAccessors\GetterPropertyAccessor;
use Weew\Validator\PropertyAccessors\ObjectPropertyAccessor;

class Validator implements IValidator {
    /**
     * @var IPropertyAccessor[]
     */
    protected $propertyAccessors;

    /**
     * @param array|null $propertyAccessors
     */
    public function __construct(array $propertyAccessors = null) {
        if ($propertyAccessors === null) {
            $propertyAccessors = $this->createPropertyAccessors();
        }

        $this->setPropertyAccessors($propertyAccessors);
    }

    /**
     * @param IPropertyAccessor $propertyAccessor
     */
    public function addPropertyAccessor(IPropertyAccessor $propertyAccessor) {
        $this->propertyAccessors[] = $propertyAccessor;
    }

    /**
     * @return IPropertyAccessor[]
     */
    public function getPropertyAccessors() {
        return $this->propertyAccessors;
    }

    /**
     * @param array $propertyPropertyAccessors
     */
    public function setPropertyAccessors(array $propertyPropertyAccessors) {
        $this->propertyAccessors = $propertyPropertyAccessors;
    }

    /**
     * @return array
     */
    protected function createPropertyAccessors() {
        return [
            new ArrayPropertyAccessor(),
            new ObjectPropertyAccessor(),
            new GetterPropertyAccessor(),
        ];
    }
}
