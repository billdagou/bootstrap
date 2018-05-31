<?php
namespace Dagou\Bootstrap\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class ProgressViewHelper extends AbstractTagBasedViewHelper {
    /**
     * @var string
     */
    protected $tagName = 'div';

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('height', 'string', 'Progress height.');
        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render() {
        $classes = [
            'progress',
        ];

        if ($this->tag->getAttribute('class')) {
            $classes[] = $this->tag->getAttribute('class');
        }

        $this->tag->addAttribute('class', implode(' ', $classes));

        if ($this->arguments['height']) {
            $this->tag->addAttribute('style', 'height:'.$this->arguments['height']);
        }

        $this->tag->setContent($this->renderChildren());

        return $this->tag->render();
    }
}