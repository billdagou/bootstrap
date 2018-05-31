<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Traits\Context;
use Dagou\Bootstrap\Traits\Uri;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class BadgeViewHelper extends AbstractTagBasedViewHelper {
    use Context, Uri;
    /**
     * @var string
     */
    protected $tagName = 'span';

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('context', 'string', 'Contextual class name.', FALSE, 'primary');
        $this->registerArgument('pill', 'boolean', 'Is pill badge or not.');
        $this->registerArgument('link', 'string', 'Link URL.');
        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render() {
        $classes = [
            'badge',
        ];

        if ($this->arguments['pill']) {
            $classes[] = 'badge-pill';
        }

        if ($this->isValidContext($this->arguments['context'])) {
            $classes[] = 'badge-'.$this->arguments['context'];
        }

        if ($this->tag->getAttribute('class')) {
            $classes[] = $this->tag->getAttribute('class');
        }

        if ($this->arguments['link']) {
            $this->tag->setTagName('a');

            $this->tag->addAttribute('href', $this->getUrl($this->arguments['link']));
        }

        $this->tag->addAttribute('class', implode(' ', $classes));

        $this->tag->setContent($this->renderChildren());

        return $this->tag->render();
    }
}