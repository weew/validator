<?php

namespace Weew\Validator;

use Weew\Validator\PropertyAccessors\ArrayPropertyAccessor;
use Weew\Validator\PropertyAccessors\GetterPropertyAccessor;
use Weew\Validator\PropertyAccessors\ObjectPropertyAccessor;

class PropertyReader implements IPropertyReader {
    /**
     * @var IPropertyAccessor[]
     */
    protected $propertyAccessors = [];

    /**
     * @param IPropertyAccessor[] $accessors
     */
    public function __construct(array $accessors = null) {
        if ($accessors === null) {
            $accessors = $this->createPropertyAccessors();
        }

        $this->setPropertyAccessors($accessors);
    }

    /**
     * @param mixed $source
     * @param string $propertyName
     *
     * @return mixed
     */
    public function getProperty($source, $propertyName) {
        foreach ($this->getPropertyAccessors() as $accessor) {
            if ($accessor->supports($source, $propertyName)) {
                return $accessor->getProperty($source, $propertyName);
            }
        }

        return null;
    }

    /**
     * @return IPropertyAccessor[]
     */
    public function getPropertyAccessors() {
        return $this->propertyAccessors;
    }

    /**
     * @param IPropertyAccessor[] $propertyAccessors
     */
    public function setPropertyAccessors(array $propertyAccessors) {
        $this->propertyAccessors = [];

        foreach ($propertyAccessors as $accessor) {
            $this->addPropertyAccessor($accessor);
        }
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
    protected function createPropertyAccessors() {
        return [
            new ArrayPropertyAccessor(),
            new ObjectPropertyAccessor(),
            new GetterPropertyAccessor(),
        ];
    }
}
