<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class ButtonViewHelper extends AbstractFormFieldViewHelper {
    /**
     * @var string
     */
    protected $tagName = 'button';
    protected string $type = 'button';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerTagAttribute('autofocus', 'string', 'Specifies that a button should automatically get focus when the page loads');
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
        $this->registerTagAttribute('form', 'string', 'Specifies one or more forms the button belongs to');

        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render(): string {
        $type = $this->type;
        $name = $this->getName();
        $this->registerFieldNameForFormTokenGeneration($name);

        $this->tag->addAttribute('type', $type);
        $this->tag->addAttribute('name', $name);
        $this->tag->addAttribute('value', $this->getValueAttribute());
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(TRUE);

        $this->tag->ignoreEmptyAttributes(TRUE);

        return $this->tag->render();
    }
}