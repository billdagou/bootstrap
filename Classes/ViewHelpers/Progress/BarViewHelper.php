<?php
namespace Dagou\Bootstrap\ViewHelpers\Progress;

use Dagou\Bootstrap\Traits\Context;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class BarViewHelper extends AbstractTagBasedViewHelper {
    use Context;
    /**
     * @var string
     */
    protected $tagName = 'div';

    public function initializeArguments() {
        $this->registerArgument('now', 'int', 'Value now.', TRUE);
        $this->registerArgument('min', 'int', 'Value min.', FALSE, 0);
        $this->registerArgument('max', 'int', 'Value max.', FALSE, 100);
        $this->registerArgument('width', 'string', 'Bar width.');
        $this->registerArgument('context', 'string', 'Contextual class name.', FALSE, 'primary');
        $this->registerArgument('stripe', 'boolean', 'Striped bar or not.');
        $this->registerArgument('animate', 'boolean', 'Animated striped bar or not.');
    }

    /**
     * @return string
     */
    public function render() {
        $classes = [
            'progress-bar',
        ];

        if ($this->isValidContext($this->arguments['context'])) {
            $classes[] = 'bg-'.$this->arguments['context'];
        }

        if ($this->arguments['stripe']) {
            $classes[] = 'progress-bar-striped';

            if ($this->arguments['animate']) {
                $classes[] = 'progress-bar-animated';
            }
        }

        $this->tag->addAttributes(
            [
                'class' => implode(' ', $classes),
                'role' => 'progressbar',
                'aria-valuenow' => $this->arguments['now'],
                'aria-valuemin' => $this->arguments['min'],
                'aria-valuemax' => $this->arguments['max'],
            ]
        );

        if ($this->arguments['width']) {
            $this->tag->addAttribute('style', 'width:'.$this->arguments['width']);
        }

        $this->tag->setContent($this->renderChildren());

        $this->tag->forceClosingTag(TRUE);

        return $this->tag->render();
    }
}