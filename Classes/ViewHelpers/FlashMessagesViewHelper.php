<?php
namespace Dagou\Bootstrap\ViewHelpers;

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class FlashMessagesViewHelper extends AbstractViewHelper {
    /**
     * @var bool
     */
    protected $escapeOutput = FALSE;
    /**
     * @var array
     */
    protected $classes = [
        FlashMessage::INFO  => 'primary',
        FlashMessage::OK => 'success',
        FlashMessage::ERROR => 'danger',
    ];

    public function initializeArguments() {
        $this->registerArgument('identifier', 'string', 'Flash-message queue identifier');
        $this->registerArgument('severity', 'string', 'Optional severity, must be either of one of \TYPO3\CMS\Core\Messaging\FlashMessage constants');
        $this->registerArgument('flush', 'boolean', 'Flush the message queue or not', FALSE, TRUE);
    }

    /**
     * @return string
     */
    public function render() {
        $severity = isset($this->classes[$this->arguments['severity']]) ? $this->classes[$this->arguments['severity']] : NULL;
        $getAllMessagesFunc = $this->arguments['flush'] ? 'getAllMessagesAndFlush' : 'getAllMessages';

        $content = '';

        if (count($flashMessages = $this->renderingContext->getControllerContext()->getFlashMessageQueue($this->arguments['identifier'])->$getAllMessagesFunc($severity))) {
            /** @var FlashMessage $flashMessage */
            foreach ($flashMessages as $flashMessage) {
                $content .= '<div class="alert alert-'.($this->classes[$flashMessage->getSeverity()] ?? 'primary').'">'.$flashMessage->getMessage().'</div>';
            }
        }

        return $content;
    }
}