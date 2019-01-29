<?php

$installer = $this;
$installer->startSetup();

$tableNameGr = $installer->getTable('powerbody_slider/group');

// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableNameGr) != true) {
	$table = $installer->getConnection()
		->newTable($tableNameGr)
		->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 5,
			[
				'unsigned' => true,
				'nullable' => false,
				'primary' => true,
				'auto_increment' => true,
			], 'Id')
		->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50,
			[
				'nullable' => true,
			], 'Name')
		->addColumn('created_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
			[
				'nullable' => true,
			], 'Created Date')
		->addColumn('updated_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
			[
				'nullable' => true,
			],
			'Updated Date');
//        ->setComment('Powerbody Slider Group Table');
	$installer->getConnection()->createTable($table);
}

$tableNameIt = $installer->getTable('powerbody_slider/item');
// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableNameIt) != true) {
	$table = $installer->getConnection()
		->newTable($tableNameIt)
		->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
			[
				'unsigned' => true,
				'nullable' => false,
				'primary' => true,
				'auto_increment' => true,
			],
			'Id'
		)
		->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
			[
				'nullable' => false,
			],
			'Title'
		)
		->addColumn('link_url', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
			[],
			'Link url'
		)
		->addColumn('bg_image', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
			[],
			'Bg Image'
		)
		->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
			[],
			'Group Id'
		)
		->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, 15,
			[],
			'Status'
		)
		->addColumn('display_from', Varien_Db_Ddl_Table::TYPE_DATE, null,
			[],
			'Display From'
		)
		->addColumn('display_to', Varien_Db_Ddl_Table::TYPE_DATE, null,
			[],
			'Display To'
		)
		->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
			[
				'nullable' => false,
				'unsigned' => true,
			],
			'Sort Order')
		->addColumn('created_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
			[
				'nullable' => true,
			], 'Created Date')
		->addColumn('updated_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
			[
				'nullable' => true,
				'unsigned' => true,
			],
			'Updated Date')
		->addForeignKey(
			$installer->getFkName(
				'powerbody_slider/item',
				'group_id',
				'powerbody_slider/group',
				'group_id'
			),
			'group_id',
			$installer->getTable('powerbody_slider/group'),
			'id',
			Varien_Db_Ddl_Table::ACTION_CASCADE,
			Varien_Db_Ddl_Table::ACTION_NO_ACTION);

	$installer->getConnection()->createTable($table);
}

$installer->endSetup();
