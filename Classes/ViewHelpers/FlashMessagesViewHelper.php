<?php
namespace Dagou\Bootstrap\ViewHelpers;

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ExtensionService;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class FlashMessagesViewHelper extends AbstractViewHelper {
    /**
     * @var bool
     */
    protected $escapeOutput = FALSE;
    /**
     * @var array
     */
    protected static $classMappings = [
        FlashMessage::NOTICE  => 'primary',
        FlashMessage::INFO  => 'info',
        FlashMessage::OK => 'success',
        FlashMessage::WARNING => 'warning',
        FlashMessage::ERROR => 'danger',
    ];

    public function initializeArguments() {
        $this->registerArgument('queueIdentifier', 'string', 'Flash-message queue to use');
        $this->registerArgument('severity', 'string', 'Optional severity, must be either of one of \TYPO3\CMS\Core\Messaging\AbstractMessage constants');
        $this->registerArgument('flush', 'boolean', 'Flush the message queue or not', FALSE, TRUE);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string {
        $severity = self::$classMappings[$arguments['severity']] ?? NULL;
        $getAllMessagesFunc = $arguments['flush'] ? 'getAllMessagesAndFlush' : 'getAllMessages';

        if (($queueIdentifier = $arguments['queueIdentifier']) === NULL) {
            $queueIdentifier = 'extbase.flashmessages.'.GeneralUtility::makeInstance(ExtensionService::class)
                ->getPluginNamespace(
                    $renderingContext->getRequest()->getControllerExtensionName(),
                    $renderingContext->getRequest()->getPluginName()
                );
        }

        $flashMessages = GeneralUtility::makeInstance(FlashMessageService::class)
            ->getMessageQueueByIdentifier($queueIdentifier)
                ->$getAllMessagesFunc($severity);

        $content = '';

        if ($flashMessages !== NULL  && count($flashMessages)) {
            /** @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
            foreach ($flashMessages as $flashMessage) {
                $content .= '<div class="alert alert-'.(self::$classMappings[$flashMessage->getSeverity()] ?? 'secondary').'">'.$flashMessage->getMessage().'</div>';
            }
        }

        return $content;
    }
}