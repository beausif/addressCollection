<?php
declare(strict_types=1);

namespace DataValidator;

/**
 * Class DataValidator
 * @package DataValidator
 */
abstract class DataValidator
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var int
     */
    protected $minimum;

    /**
     * @var int
     */
    protected $maximum;

    /**
     * @var mixed
     */
    protected $filteredData;

    /**
     * DataValidator constructor.
     */
    private function __construct(){ }

    /**
     *
     */
    abstract protected function sanitizeData(): void;

    /**
     *
     */
    abstract protected function validateData(): void;

    /**
     *
     */
    abstract protected function checkMinimum(): bool;

    /**
     *
     */
    abstract protected function checkMaximum(): bool;

    /**
     * @return mixed
     */
    abstract public function getData();

}
