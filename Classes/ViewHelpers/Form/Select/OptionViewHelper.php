<?php
namespace Dagou\Bootstrap\ViewHelpers\Form\Select;

use Dagou\Bootstrap\ViewHelpers\Form\SelectViewHelper;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class OptionViewHelper extends AbstractFormFieldViewHelper {
    /**
     * @var string
     */
    protected $tagName = 'option';

    public function initializeArguments(): void {
        $this->registerUniversalTagAttributes();

        $this->registerArgument('selected', 'boolean', 'If set, overrides automatic detection of selected state for this option.');
        $this->registerArgument('additionalAttributes', 'array', 'Additional tag attributes. They will be added directly to the resulting HTML tag.');
        $this->registerArgument('data', 'array', 'Additional data-* attributes. They will each be added with a "data-" prefix.');
        $this->registerTagAttribute('value', 'mixed', 'Value to be inserted in HTML tag - must be convertible to string!');
    }

    /**
     * @return string
     */
    public function render(): string {
        $childContent = $this->renderChildren();
        $this->tag->setContent($childContent);
        $value = $this->arguments['value'] ?? $childContent;
        if ($this->arguments['selected'] ?? $this->isValueSelected((string)$value)) {
            $this->tag->addAttribute('selected', 'selected');
        }
        $this->tag->addAttribute('value', $value);
        $parentRequestedFormTokenFieldName = $this->renderingContext->getViewHelperVariableContainer()->get(
            SelectViewHelper::class,
            'registerFieldNameForFormTokenGeneration'
        );
        if ($parentRequestedFormTokenFieldName) {
            $this->registerFieldNameForFormTokenGeneration($parentRequestedFormTokenFieldName);
        }
        return $this->tag->render();
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function isValueSelected(string $value): bool {
        $selectedValue = $this->renderingContext->getViewHelperVariableContainer()->get(SelectViewHelper::class, 'selectedValue');
        if (is_array($selectedValue)) {
            return in_array($value, array_map(strval(...), $selectedValue), TRUE);
        }
        if ($selectedValue instanceof \Iterator) {
            return in_array($value, array_map(strval(...), iterator_to_array($selectedValue)), TRUE);
        }
        return $value === (string)$selectedValue;
    }
}