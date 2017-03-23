<?php
namespace Dagou\Bootstrap\ViewHelpers;

class AlertViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
	/**
	 * @var array
	 */
	protected $status = [
		\TYPO3\CMS\Core\Messaging\AbstractMessage::NOTICE => 'warning',
		\TYPO3\CMS\Core\Messaging\AbstractMessage::INFO => 'info',
		\TYPO3\CMS\Core\Messaging\AbstractMessage::OK => 'success',
		\TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING => 'warning',
		\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR => 'danger',
	];

	/**
	 * {@inheritDoc}
	 * @see \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper::initializeArguments()
	 */
	public function initializeArguments() {
		$this->registerArgument('identifier', 'string', 'Flash-message queue to use.');
	}

	/**
	 * @return string
	 */
	public function render() {
		$flashMessages = $this->controllerContext
			->getFlashMessageQueue($this->arguments['identifier'])
			->getAllMessagesAndFlush();

		if ($flashMessages === NULL || count($flashMessages) === 0) {
			return '';
		}

		$content = '';

		foreach ($flashMessages as $flashMessage) {
			$this->tag->addAttributes([
				'class' => 'alert alert-'.($this->status[$flashMessage->getSeverity()] ?? 'unknown'),
				'role' => 'alert',
			]);
			$this->tag->setContent($flashMessage->getMessage());

			$content .= $this->tag->render();
		}

		return $content;
	}
}