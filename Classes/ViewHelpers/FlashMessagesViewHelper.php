<?php
namespace Dagou\Bootstrap\ViewHelpers;

use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ExtensionService;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class FlashMessagesViewHelper extends AbstractViewHelper {
    /**
     * @var bool
     */
    protected $escapeOutput = FALSE;

    public function initializeArguments(): void {
        $this->registerArgument('queueIdentifier', 'string', 'Flash-message queue to use');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string {
        if (($queueIdentifier = $arguments['queueIdentifier']) === NULL) {
            $queueIdentifier = 'extbase.flashmessages.'.GeneralUtility::makeInstance(ExtensionService::class)
                ->getPluginNamespace(
                    $renderingContext->getRequest()->getControllerExtensionName(),
                    $renderingContext->getRequest()->getPluginName()
                );
        }

        $flashMessages = GeneralUtility::makeInstance(FlashMessageService::class)
            ->getMessageQueueByIdentifier($queueIdentifier)
                ->getAllMessagesAndFlush();

        $content = '';

        if (count($flashMessages) > 0) {
            /** @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
            foreach ($flashMessages as $flashMessage) {
                $content .= '<div class="alert alert-'.self::getClassMappings($flashMessage->getSeverity()).'" role="alert">'.$flashMessage->getMessage().'</div>';
            }
        }

        return $content;
    }

    /**
     * @param \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity $severity
     *
     * @return string
     */
    protected static function getClassMappings(ContextualFeedbackSeverity $severity): string {
        return match ($severity) {
            ContextualFeedbackSeverity::NOTICE => 'primary',
            ContextualFeedbackSeverity::INFO => 'info',
            ContextualFeedbackSeverity::OK => 'success',
            ContextualFeedbackSeverity::WARNING => 'warning',
            ContextualFeedbackSeverity::ERROR => 'danger',
            default => 'secondary',
        };
    }
}