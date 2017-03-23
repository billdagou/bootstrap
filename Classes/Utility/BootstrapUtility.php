<?php
namespace Dagou\Bootstrap\Utility;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Dagou\Jquery\Utility\JqueryUtility;

class BootstrapUtility {
	/**
	 * @param string $js
	 * @param string $css
	 * @param bool $footer
	 * @return void
	 */
	static public function loadBootstrap($js = NULL, $css = NULL, $footer = TRUE) {
		JqueryUtility::loadJquery($footer);

		/** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
		$pageRenderer = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);

		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['bootstrap']);
		$siteRelPath = ExtensionManagementUtility::siteRelPath('bootstrap');

		if ($css) {
			$pageRenderer->addCssLibrary($css);
		} elseif ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'][$extConf['cdn']]['css']) {
			$pageRenderer->addCssLibrary($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'][$extConf['cdn']]['css']);
		} else {
			$pageRenderer->addCssLibrary($siteRelPath.'Resources/Public/css/bootstrap.min.css');
		}

		$func = $footer ? 'addJsFooterLibrary' : 'addJsLibrary';

		if ($js) {
			$pageRenderer->$func('bootstrap', $js);
		} elseif ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'][$extConf['cdn']]['js']) {
			$pageRenderer->$func('bootstrap', $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'][$extConf['cdn']]['js']);
		} else {
			$pageRenderer->$func('bootstrap', $siteRelPath.'Resources/Public/js/bootstrap.min.js');
		}

		$func = $footer ? 'addFooterData' : 'addHeaderData';

		$pageRenderer->$func('<!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->');
	}

	/**
	 * @param string $theme
	 * @return void
	 */
	static public function loadBootstrapTheme($theme = NULL) {
		/** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
		$pageRenderer = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);

		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['bootstrap']);

		if ($theme) {
			$pageRenderer->addCssLibrary($theme);
		} elseif ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'][$extConf['cdn']]['theme']) {
			$pageRenderer->addCssLibrary($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'][$extConf['cdn']]['theme']);
		} else {
			$siteRelPath = ExtensionManagementUtility::siteRelPath('bootstrap');

			$pageRenderer->addCssLibrary($siteRelPath.'Resources/Public/css/bootstrap-theme.min.css');
		}
	}
}