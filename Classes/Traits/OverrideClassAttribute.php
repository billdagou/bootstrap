<?php
namespace Dagou\Bootstrap\Traits;

trait OverrideClassAttribute {
    /**
     * @param string $defaultValue
     */
    protected function overrideClassAttribute(string $defaultValue) {
        $this->overrideArgument('class', 'string', 'CSS class(es) for this element', FALSE, $defaultValue);
    }
}