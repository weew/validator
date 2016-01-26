<?php

namespace Tests\Weew\Validator\Mocks;

use Exception;
use Weew\Validator\IValidationData;

class FakeValidationDataWrapperException extends Exception {
    /**
     * @var IValidationData
     */
    private $data;

    public function __construct(IValidationData $data) {
        $this->data = $data;
    }

    /**
     * @return IValidationData
     */
    public function getData() {
        return $this->data;
    }
}
