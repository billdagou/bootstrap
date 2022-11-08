<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideTypeAttribute;

class ButtonViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\ButtonViewHelper {
    use OverrideTypeAttribute;

    public function initializeArguments() {
        parent::initializeArguments();

        $this->overrideTypeAttribute('button');
    }

    /**
     * @return string
     */
    public function render(): string {
        $this->tag->addAttribute('type', $this->arguments['type']);

        if (($name = $this->getName())) {
            $this->registerFieldNameForFormTokenGeneration($name);
        }

        if (($value = $this->getValueAttribute())) {
            $this->tag->addAttribute('value', $value);
        }

        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(TRUE);

        return $this->tag->render();
    }
}