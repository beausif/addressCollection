<?php
declare(strict_types=1);

namespace DataValidator;

/**
 * Class StringValidator
 * @package DataValidator
 */
class StringValidator extends DataValidator
{

    /**
     * StringValidator constructor.
     * @param string $data
     * @param int $minimum
     * @param int $maximum
     */
    public function __construct(?string $data, ?int $minimum = 0, ?int $maximum = 2147483647)
    {
        $this->data = trim($data);
        $this->minimum = $minimum;
        $this->maximum = $maximum;

        $this->sanitizeData();
        $this->validateData();
    }

    /**
     *
     */
    protected function sanitizeData(): void
    {
        $this->filteredData = filter_var($this->data, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }

    /**
     *
     */
    protected function validateData(): void
    {
        if ($this->filteredData === false || $this->filteredData === 'null' || $this->checkMinimum() === false || $this->checkMaximum() === false) {
            $this->filteredData = null;
        }
    }

    /**
     * @return bool
     */
    protected function checkMinimum(): bool
    {
        if (!is_null($this->minimum) && strlen($this->filteredData) < $this->minimum) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    protected function checkMaximum(): bool
    {
        if (!is_null($this->maximum) && strlen($this->filteredData) > $this->maximum) {
            return false;
        }
        return true;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->filteredData;
    }

}
