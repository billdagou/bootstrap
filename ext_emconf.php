<?php
$EM_CONF[$_EXTKEY] = [
	'title' => 'Bootstrap',
	'description' => 'Bootstrap, http://getbootstrap.com/',
	'category' => 'misc',
	'constraints' => [
		'depends' => [
			'fluidcontent' => '',
			'flux' => '',
			'jquery' => '',
			'vhs' => '',
		],
		'suggests' => [
			'rtehtmlarea' => '7.6.0-7.6.99',
		],
	],
	'state' => 'stable',
	'author' => 'Bill.Dagou',
	'author_email' => 'billdagou@gmail.com',
	'version' => '3.3.7',
];