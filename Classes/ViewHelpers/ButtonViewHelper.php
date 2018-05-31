<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Traits\Context;
use Dagou\Bootstrap\Traits\Size;
use Dagou\Bootstrap\Traits\Uri;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class ButtonViewHelper extends AbstractTagBasedViewHelper {
    use Context, Size, Uri;
    /**
     * @var string
     */
    protected $tagName = 'button';

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('type', 'string', 'Button type.', FALSE, 'button');
        $this->registerArgument('context', 'string', 'Contextual class name.', FALSE, 'primary');
        $this->registerArgument('outline', 'boolean', 'Is outline button or not.');
        $this->registerArgument('size', 'string', 'Button size.');
        $this->registerArgument('block', 'boolean', 'Block level button or not.');
        $this->registerArgument('active', 'boolean', 'Active or not.');
        $this->registerArgument('disabled', 'boolean', 'Disabled or not.');
        $this->registerArgument('link', 'string', 'Link URL.');
        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render() {
        $classes = [
            'btn',
        ];

        if ($this->isValidContext($this->arguments['context'])) {
            $classes[] = ($this->arguments['outline'] ? 'btn-outline-' : 'btn-').$this->arguments['context'];
        }

        if ($this->arguments['size'] && $this->isValidSize($this->arguments['size'])) {
            $classes[] = 'btn-'.$this->arguments['size'];
        }

        if ($this->arguments['block']) {
            $classes[] = 'btn-block';
        }

        if ($this->arguments['link']) {
            $this->tag->setTagName('a');

            $this->tag->addAttributes(
                [
                    'href' => $this->getUrl($this->arguments['link']),
                    'role' => 'button',
                ]
            );

            if ($this->arguments['active']) {
                $classes[] = 'active';

                $this->tag->addAttribute('aria-pressed', 'true');
            }

            if ($this->arguments['disabled']) {
                $classes[] = 'disabled';

                $this->tag->addAttributes(
                    [
                        'tabindex' => '-1',
                        'aria-disabled' => 'true',
                    ]
                );
            }
        } else {
            $this->tag->addAttribute('type', $this->arguments['type']);

            if ($this->arguments['disabled']) {
                $this->tag->addAttribute('disabled', 'disabled');
            }
        }

        if ($this->tag->getAttribute('class')) {
            $classes[] = $this->tag->getAttribute('class');
        }

        $this->tag->addAttribute('class', implode(' ', $classes));

        $this->tag->setContent($this->renderChildren());

        return $this->tag->render();
    }
}