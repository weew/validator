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
     * @param IPropertyReader $propertyReader
     * @param $data
     */
    public function __construct(IPropertyReader $propertyReader, $data) {
        $this->propertyReader = $propertyReader;
        $this->data = $data;
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
}
