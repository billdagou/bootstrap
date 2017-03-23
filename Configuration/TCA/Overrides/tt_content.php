<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$additionalColumns = [
	'bootstrap_page_header' => [
		'label' => 'LLL:EXT:bootstrap/Resources/Private/Language/locallang_db.xlf:bootstrap_page_header',
		'exclude' => TRUE,
		'config' => [
			'type' => 'check',
			'items' => [
				[
					'LLL:EXT:bootstrap/Resources/Private/Language/locallang_db.xlf:bootstrap_page_header.I.0',
				],
			],
		],
	],
	'linkToTop_position' => [
		'label' => 'LLL:EXT:bootstrap/Resources/Private/Language/locallang_db.xlf:linkToTop_position',
		'exclude' => TRUE,
		'config' => [
			'type' => 'select',
			'items' => [
				['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', ''],
				['LLL:EXT:bootstrap/Resources/Private/Language/locallang_db.xlf:linkToTop_position.I.1', 'right'],
				['LLL:EXT:bootstrap/Resources/Private/Language/locallang_db.xlf:linkToTop_position.I.2', 'center'],
				['LLL:EXT:bootstrap/Resources/Private/Language/locallang_db.xlf:linkToTop_position.I.3', 'left'],
			],
		],
	],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'header', 'bootstrap_page_header', 'replace:date');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'headers', 'bootstrap_page_header', 'replace:date');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'visibility', 'linkToTop_position', 'after:linkToTop');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'header_layout',
	['LLL:EXT:bootstrap/Resources/Private/Language/locallang_db.xlf:header_layout.I.6', 6],
	'5',
	'after'
);