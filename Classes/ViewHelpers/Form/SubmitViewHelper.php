<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class SubmitViewHelper extends ButtonViewHelper {
    protected string $type = 'submit';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerTagAttribute('formaction', 'string', 'Specifies where to send the form-data when a form is submitted.');
        $this->registerTagAttribute('formenctype', 'string', 'Specifies how form-data should be encoded before sending it to a server. (e.g. "application/x-www-form-urlencoded", "multipart/form-data" or "text/plain")');
        $this->registerTagAttribute('formmethod', 'string', 'Specifies how to send the form-data (which HTTP method to use). (e.g. "get" or "post")');
        $this->registerTagAttribute('formnovalidate', 'string', 'Specifies that the form-data should not be validated on submission.');
        $this->registerTagAttribute('formtarget', 'string', 'Specifies where to display the response after submitting the form. (e.g. "_blank", "_self", "_parent", "_top", "framename")');
    }
}