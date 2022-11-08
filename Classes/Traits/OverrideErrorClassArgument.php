<?php
namespace Dagou\Bootstrap\Traits;

trait OverrideErrorClassArgument {
    protected function overrideErrorClassArgument() {
        $this->overrideArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'is-invalid');
    }
}