<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use DateTime;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class DateFilter extends Filter
{
    public array $options = [];

    public function options(array $options = []): DateFilter
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function validate($value)
    {
        if (DateTime::createFromFormat($this->getOptions()['dateFormat'] ?? 'Y-m-d', $value) === false) {
            return false;
        }

        return $value;
    }

    public function isEmpty($value): bool
    {
        return $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }

    public function render(string $filterLayout, string $tableName, bool $isTailwind, bool $isBootstrap4, bool $isBootstrap5)
    {
        return view('livewire-tables::components.tools.filters.date', [
            'filterLayout' => $filterLayout,
            'tableName' => $tableName,
            'isTailwind' => $isTailwind,
            'isBootstrap' => ($isBootstrap4 || $isBootstrap5),
            'isBootstrap4' => $isBootstrap4,
            'isBootstrap5' => $isBootstrap5,
            'filter' => $this,
        ]);
    }
}
