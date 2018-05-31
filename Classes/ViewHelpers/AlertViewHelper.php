<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Traits\Context;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class AlertViewHelper extends AbstractTagBasedViewHelper {
    use Context;
    /**
     * @var string
     */
    protected $tagName = 'div';

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('context', 'string', 'Contextual class name.', FALSE, 'primary');
        $this->registerArgument('dismiss', 'boolean', 'Allow dismissing or not.');
        $this->registerArgument('animate', 'boolean', 'Animated dismissing or not.', FALSE, TRUE);
        $this->registerArgument('label', 'string', 'ARIA label.', FALSE, 'Close');
        $this->registerArgument('symbol', 'string', 'Dismissing symbol.', FALSE, '&times;');
        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render() {
        if (($content = $this->renderChildren())) {
            $classes = [
                'alert',
            ];

            if ($this->isValidContext($this->arguments['context'])) {
                $classes[] = 'alert-'.$this->arguments['context'];
            }

            if ($this->arguments['dismiss']) {
                $classes[] = 'alert-dismissible';

                if ($this->arguments['animate']) {
                    $classes[] = 'fade show';
                }

                $content .= '<button type="button" class="close" data-dismiss="alert" aria-label="'.$this->arguments['label'].'"><span aria-hidden="true">'.$this->arguments['symbol'].'</span></button>';
            }

            if ($this->tag->getAttribute('class')) {
                $classes[] = $this->tag->getAttribute('class');
            }

            $this->tag->addAttributes(
                [
                    'class' => implode(' ', $classes),
                    'role' => 'alert',
                ]
            );

            $this->tag->setContent($content);

            return $this->tag->render();
        }
    }
}