<?php
namespace Dagou\Bootstrap\Traits;

trait OverrideTypeAttribute {
    /**
     * @param string $defaultValue
     */
    protected function overrideTypeAttribute(string $defaultValue) {
        $this->overrideArgument('type', 'string', 'Specifies the type of button', FALSE, $defaultValue);
    }
}