<?php
namespace Dagou\Bootstrap\ViewHelpers;

class LoadJsViewHelper extends AbstractLoadViewHelper {
    public function initializeArguments() {
        $this->registerArgument('footer', 'boolean', 'Add to footer or not.', FALSE, TRUE);
        $this->registerArgument('js', 'string', 'Bootstrap .JS file path.');
    }

    public function render() {
        $cdn = $this->getCDN((bool)$this->arguments['js']);

        $cdn->loadJs($this->arguments['js'], $this->arguments['footer']);
    }
}