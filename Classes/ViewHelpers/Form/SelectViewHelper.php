<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;

class SelectViewHelper extends AbstractFormFieldViewHelper {
    use OverrideClassAttribute;

    /**
     * @var string
     */
    protected $tagName = 'select';
    protected mixed $selectedValue;

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'is-invalid');
        $this->registerArgument('multiple', 'boolean', 'If set multiple options may be selected.', FALSE, FALSE);
        $this->registerArgument('optionValueField', 'string', 'If specified, will call the appropriate getter on each object to determine the value.');
        $this->registerArgument('optionLabelField', 'string', 'If specified, will call the appropriate getter on each object to determine the label.');
        $this->registerArgument('options', 'array', 'Associative array with internal IDs as key, and the values are displayed in the select box. Can be combined with or replaced by child f:form.select.* nodes.');
        $this->registerArgument('optionsAfterContent', 'boolean', 'If true, places auto-generated option tags after those rendered in the tag content. If false, automatic options come first.', FALSE, FALSE);
        $this->registerArgument('prependOptionLabel', 'string', 'If specified, will provide an option at first position with the specified label.');
        $this->registerArgument('prependOptionValue', 'string', 'If specified, will provide an option at first position with the specified value.');
        $this->registerArgument('required', 'boolean', 'If set no empty value is allowed.', FALSE, FALSE);
        $this->registerArgument('selectAllByDefault', 'boolean', 'If specified options are selected if none was set before.', FALSE, FALSE);
        $this->registerArgument('sortByOptionLabel', 'boolean', 'If true, List will be sorted by label.', FALSE, FALSE);
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
        $this->registerTagAttribute('size', 'string', 'Size of select field, a numeric value to show the amount of items to be visible at the same time - equivalent to HTML <select> site attribute');

        $this->registerUniversalTagAttributes();

        $this->overrideClassAttribute('form-select');
    }

    /**
     * @return string
     */
    public function render(): string {
        if ($this->arguments['required']) {
            $this->tag->addAttribute('required', 'required');
        }
        $name = $this->getName();
        if ($this->arguments['multiple']) {
            $this->tag->addAttribute('multiple', 'multiple');
            $name .= '[]';
        }
        $this->tag->addAttribute('name', $name);
        $options = $this->getOptions();

        $viewHelperVariableContainer = $this->renderingContext->getViewHelperVariableContainer();

        $this->addAdditionalIdentityPropertiesIfNeeded();
        $this->setErrorClassAttribute();
        $content = '';

        $this->registerFieldNameForFormTokenGeneration($name);

        if ($this->arguments['multiple']) {
            $content .= $this->renderHiddenFieldForEmptyValue();

            $optionsCount = count($options);
            for ($i = 1; $i < $optionsCount; $i++) {
                $this->registerFieldNameForFormTokenGeneration($name);
            }

            $viewHelperVariableContainer->addOrUpdate(
                self::class,
                'registerFieldNameForFormTokenGeneration',
                $name
            );
        }

        $viewHelperVariableContainer->addOrUpdate(self::class, 'selectedValue', $this->getSelectedValue());
        $prependContent = $this->renderPrependOptionTag();
        $tagContent = $this->renderOptionTags($options);
        $childContent = $this->renderChildren();
        $viewHelperVariableContainer->remove(self::class, 'selectedValue');
        $viewHelperVariableContainer->remove(self::class, 'registerFieldNameForFormTokenGeneration');
        if (isset($this->arguments['optionsAfterContent']) && $this->arguments['optionsAfterContent']) {
            $tagContent = $childContent . $tagContent;
        } else {
            $tagContent .= $childContent;
        }
        $tagContent = $prependContent . $tagContent;

        $this->tag->forceClosingTag(TRUE);
        $this->tag->setContent($tagContent);
        $content .= $this->tag->render();
        return $content;
    }

    /**
     * @return string
     */
    protected function renderPrependOptionTag(): string {
        $output = '';

        if ($this->hasArgument('prependOptionLabel')) {
            $value = $this->hasArgument('prependOptionValue') ? $this->arguments['prependOptionValue'] : '';
            $label = $this->arguments['prependOptionLabel'];
            $output .= $this->renderOptionTag((string)$value, (string)$label, FALSE) . LF;
        }

        return $output;
    }

    /**
     * @param array $options
     *
     * @return string
     */
    protected function renderOptionTags(array $options): string {
        $output = '';

        foreach ($options as $value => $label) {
            $isSelected = $this->isSelected($value);
            $output .= $this->renderOptionTag((string)$value, (string)$label, $isSelected) . LF;
        }

        return $output;
    }

    /**
     * @return array
     */
    protected function getOptions(): array {
        if (!is_array($this->arguments['options']) && !$this->arguments['options'] instanceof \Traversable) {
            return [];
        }

        $options = [];
        $optionsArgument = $this->arguments['options'];

        foreach ($optionsArgument as $key => $value) {
            if (!is_object($value) && !is_array($value)) {
                $options[$key] = $value;

                continue;
            }

            if (is_array($value)) {
                if (!$this->hasArgument('optionValueField')) {
                    throw new \InvalidArgumentException('Missing parameter "optionValueField" in SelectViewHelper for array value options.', 1682693720);
                }
                if (!$this->hasArgument('optionLabelField')) {
                    throw new \InvalidArgumentException('Missing parameter "optionLabelField" in SelectViewHelper for array value options.', 1682693721);
                }

                $key = ObjectAccess::getPropertyPath($value, $this->arguments['optionValueField']);
                $value = ObjectAccess::getPropertyPath($value, $this->arguments['optionLabelField']);
                $options[$key] = $value;

                continue;
            }

            if ($this->hasArgument('optionValueField')) {
                $key = ObjectAccess::getPropertyPath($value, $this->arguments['optionValueField']);

                if (is_object($key)) {
                    if (method_exists($key, '__toString')) {
                        $key = (string)$key;
                    } else {
                        throw new Exception('Identifying value for object of class "' . get_debug_type($value) . '" was an object.', 1247827428);
                    }
                }
            } elseif ($this->persistenceManager->getIdentifierByObject($value) !== NULL) {
                $key = $this->persistenceManager->getIdentifierByObject($value);
            } elseif (is_object($value) && method_exists($value, '__toString')) {
                $key = (string)$value;
            } elseif (is_object($value)) {
                throw new Exception('No identifying value for object of class "' . get_class($value) . '" found.', 1247826696);
            }

            if ($this->hasArgument('optionLabelField')) {
                $value = ObjectAccess::getPropertyPath($value, $this->arguments['optionLabelField']);
                if (is_object($value)) {
                    if (method_exists($value, '__toString')) {
                        $value = (string)$value;
                    } else {
                        throw new Exception('Label value for object of class "' . get_class($value) . '" was an object without a __toString() method.', 1247827553);
                    }
                }
            } elseif (is_object($value) && method_exists($value, '__toString')) {
                $value = (string)$value;
            } elseif ($this->persistenceManager->getIdentifierByObject($value) !== NULL) {
                $value = $this->persistenceManager->getIdentifierByObject($value);
            }
            $options[$key] = $value;
        }

        if ($this->arguments['sortByOptionLabel']) {
            asort($options, SORT_LOCALE_STRING);
        }

        return $options;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    protected function isSelected(mixed $value): bool {
        $selectedValue = $this->getSelectedValue();

        if ($value === $selectedValue || (string)$value === $selectedValue) {
            return TRUE;
        }

        if ($this->hasArgument('multiple')) {
            if ($selectedValue === NULL && $this->arguments['selectAllByDefault'] === TRUE) {
                return TRUE;
            }
            if (is_array($selectedValue) && in_array($value, $selectedValue)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * @return mixed
     */
    protected function getSelectedValue(): mixed {
        $this->setRespectSubmittedDataValue(TRUE);
        $value = $this->getValueAttribute();

        if (!is_array($value) && !$value instanceof \Traversable) {
            return $this->getOptionValueScalar($value);
        }

        $selectedValues = [];
        foreach ($value as $selectedValueElement) {
            $selectedValues[] = $this->getOptionValueScalar($selectedValueElement);
        }

        return $selectedValues;
    }

    /**
     * @param mixed $valueElement
     *
     * @return string
     */
    protected function getOptionValueScalar(mixed $valueElement): string {
        if (is_object($valueElement)) {
            if ($this->hasArgument('optionValueField')) {
                return ObjectAccess::getPropertyPath($valueElement, $this->arguments['optionValueField']);
            }

            if ($this->persistenceManager->getIdentifierByObject($valueElement) !== NULL) {
                return $this->persistenceManager->getIdentifierByObject($valueElement);
            }

            return (string)$valueElement;
        }

        return $valueElement;
    }

    /**
     * @param string $value
     * @param string $label
     * @param bool $isSelected
     *
     * @return string
     */
    protected function renderOptionTag(string $value, string $label, bool $isSelected): string {
        $output = '<option value="'.htmlspecialchars($value).'"';

        if ($isSelected) {
            $output .= ' selected="selected"';
        }

        $output .= '>'.htmlspecialchars($label).'</option>';

        return $output;
    }
}