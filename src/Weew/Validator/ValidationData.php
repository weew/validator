<?php

namespace Weew\Validator;

use Traversable;
use Weew\Contracts\IArrayable;

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
     * @param string $key
     *
     * @return array
     */
    public function get($key) {
        return $this->getValues(
            $this->data, $this->splitKey($key)
        );
    }

    /**
     * @param mixed $data
     * @param array $keys
     *
     * @return array
     */
    protected function getValues($data, array $keys) {
        $key = array_shift($keys);

        if (array_contains(['', null], $key)) {
            return [];
        }

        if ($key === ValidationToken::WILDCARD_VALUES) {
            $values = $this->getWildcardValues($data, $keys);
        } else if ($key === ValidationToken::WILDCARD_KEYS) {
            $values = $this->getWildcardKeys($data, $keys);
        } else {
            $values = $this->getRegularValues($data, $key, $keys);
        }

        return $values;
    }

    /**
     * @param mixed $data
     * @param array $keys
     *
     * @return array
     */
    protected function getWildcardKeys($data, array $keys) {
        $values = [];

        if ( ! is_array($data) && ! $data instanceof Traversable) {
            if ($data instanceof IArrayable) {
                $data = $data->toArray();
            }

            if ( ! is_array($data)) {
                $data = [];
            }
        }

        foreach ($data as $itemKey => $itemValue) {
            $values[$itemKey] = $itemKey;
        }

        return $values;
    }

    /**
     * @param mixed $data
     * @param array $keys
     *
     * @return array
     */
    protected function getWildcardValues($data, array $keys) {
        $values = [];

        if ( ! is_array($data) && ! $data instanceof Traversable) {
            if ($data instanceof IArrayable) {
                $data = $data->toArray();
            }

            if ( ! is_array($data)) {
                $data = [];
            }
        }

        if (count($keys) === 0) {
            foreach ($data as $itemKey => $itemValue) {
                $values[$itemKey] = $itemValue;
            }
        }

        if (count($keys) > 0) {
            foreach ($data as $itemKey => $itemValue) {
                $nestedValues = $this->getValues($itemValue, $keys);
                $isLastWildcard = ! array_contains($keys, ValidationToken::WILDCARD_VALUES);

                foreach ($nestedValues as $nestedKey => $nestedValue) {
                    // do no collect null values unless it is the last wildcard node
                    if ($nestedValue !== null || $isLastWildcard) {
                        $values[$this->buildKey($itemKey, $nestedKey)] = $nestedValue;
                    }
                }
            }
        }

        return $values;
    }

    /**
     * @param mixed $data
     * @param string $key
     * @param array $keys
     *
     * @return array
     */
    protected function getRegularValues($data, $key, array $keys) {
        $values = [];

        if (count($keys) === 0) {
            $values[$key] = $this->propertyReader->getProperty($data, $key);
        }

        if (count($keys) > 0) {
            $value = $this->propertyReader->getProperty($data, $key);
            $nestedValues = $this->getValues($value, $keys);

            foreach ($nestedValues as $nestedKey => $nestedValue) {
                $values[$this->buildKey($key, $nestedKey)] = $nestedValue;
            }
        }

        return $values;
    }

    /**
     * @param string $key
     *
     * @return array
     */
    protected function splitKey($key) {
        return explode('.', $key);
    }

    /**
     * @param array ...$keys
     *
     * @return string
     */
    protected function buildKey($keys) {
        return implode('.', func_get_args());
    }

    /**
     * @return IPropertyReader
     */
    protected function createPropertyReader() {
        return new PropertyReader();
    }
}
