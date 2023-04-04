<?php
	// TODO: Create ORM like functional for creating/updating/deleting new data types

	$newsRubricType = 'news_rubric';
	$newsRubricTypeFields = [
		'obj_id' => [
			'type' => 'int(10) unsigned DEFAULT NULL',
			'primary' => true
		],
		'title' => [
			'type' => 'varchar(255) DEFAULT NULL'
		]
	];

	$newsItemType = 'news_item';
	$newsItemTypeFields = [
		'obj_id' => [
			'type' => 'int(10) unsigned DEFAULT NULL',
			'primary' => true
		],
		'title' => [
			'type' => 'varchar(255) DEFAULT NULL'
		],
		'anons' => [
			'type' => 'varchar(1024) DEFAULT NULL'
		],
		'content' => [
			'type' => 'text DEFAULT NULL'
		]
	];

	// TODO: Create ORM like functional for creating/updating/deleting new data types