<?php

namespace Weew\Validator;

class Validator implements IValidator {
    /**
     * @var IPropertyAccessor[]
     */
    protected $accessors;

    /**
     * @param IPropertyAccessor $accessor
     */
    public function addAccessor(IPropertyAccessor $accessor) {
        $this->accessors[] = $accessor;
    }

    /**
     * @param array $accessors
     *
     * @return IPropertyAccessor[]
     */
    public function getAccessors(array $accessors) {
        return $this->accessors;
    }

    /**
     * @param array $accessors
     */
    public function setAccessors(array $accessors) {
        $this->accessors = $accessors;
    }
}
