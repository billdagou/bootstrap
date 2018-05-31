<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Traits\Asset;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class ImageViewHelper extends AbstractTagBasedViewHelper {
    use Asset;
    /**
     * @var string
     */
    protected $tagName = 'img';

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('src', 'string', 'Image path.', TRUE);
        $this->registerArgument('responsive', 'boolean', 'Is responsive image or not.');
        $this->registerArgument('thumbnail', 'boolean', 'Is thumbnail or not.');
        $this->registerTagAttribute('alt', 'string', 'Alternative text.');
        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render() {
        $classes = [];

        if ($this->arguments['responsive']) {
            $classes[] = 'img-fluid';
        }

        if ($this->arguments['thumbnail']) {
            $classes[] = 'img-thumbnail';
        }

        if ($this->tag->getAttribute('class')) {
            $classes[] = $this->tag->getAttribute('class');
        }

        if (count($classes)) {
            $this->tag->addAttribute('class', implode(' ', $classes));
        }

        $this->tag->addAttribute('src', $this->getAssetPath($this->arguments['src']));

        return $this->tag->render();
    }
}