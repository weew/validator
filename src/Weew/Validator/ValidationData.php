<?php

namespace Weew\Validator;

class ValidationData implements IValidationData {
    /**
     * @var IPropertyReader
     */
    protected $propertyReader;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * ValidationData constructor.
     *
     * @param $data
     * @param IPropertyReader $propertyReader
     */
    public function __construct($data, IPropertyReader $propertyReader = null) {
        if ( ! $propertyReader instanceof IPropertyReader) {
            $propertyReader = $this->createPropertyReader();
        }

        $this->data = $data;
        $this->propertyReader = $propertyReader;
    }

    /**
     * @param $key
     * @param null $defaultValue
     *
     * @return mixed|null
     */
    public function get($key, $defaultValue = null) {
        $value = $this->propertyReader->getProperty($this->data, $key);

        if ($value === null) {
            return $defaultValue;
        }

        return $value;
    }

    /**
     * @return IPropertyReader
     */
    protected function createPropertyReader() {
        return new PropertyReader();
    }
}
