<?php

$installer = $this;
$installer->startSetup();

$tableNameGr = $installer->getTable('powerbody_slider/group');

// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableNameGr) != TRUE) {
    $table = $installer->getConnection()
        ->newTable($tableNameGr)
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 5,
            [
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
                'auto_increment' => TRUE,
            ], 'Id')
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50,
            [
                'nullable' => TRUE,
            ],
            'Name')
        ->addColumn('created_date', Varien_Db_Ddl_Table::TYPE_DATE, NULL,
            [
                'nullable' => TRUE,
            ], 'Created Date')
        ->addColumn('updated_date', Varien_Db_Ddl_Table::TYPE_DATE, NULL,
            [
                'nullable' => TRUE,
            ],
            'Updated Date');
    $installer->getConnection()->createTable($table);
}

$tableNameIt = $installer->getTable('powerbody_slider/item');
// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableNameIt) != TRUE) {
    $table = $installer->getConnection()
        ->newTable($tableNameIt)
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, NULL,
            [
                'unsigned' => TRUE,
                'nullable' => FALSE,
                'primary' => TRUE,
                'auto_increment' => TRUE,
            ],
            'Id'
        )
        ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
            [
                'nullable' => FALSE,
            ],
            'Title'
        )
        ->addColumn('link_url', Varien_Db_Ddl_Table::TYPE_VARCHAR, NULL,
            [],
            'Link url'
        )
        ->addColumn('bg_image', Varien_Db_Ddl_Table::TYPE_VARCHAR, NULL,
            [],
            'Bg Image'
        )
        ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, NULL,
            [],
            'Group Id'
        )
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, 15,
            [],
            'Status'
        )
        ->addColumn('display_from', Varien_Db_Ddl_Table::TYPE_DATE, NULL,
            [],
            'Display From'
        )
        ->addColumn('display_to', Varien_Db_Ddl_Table::TYPE_DATE, NULL,
            [],
            'Display To'
        )
        ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_INTEGER, NULL,
            [
                'nullable' => FALSE,
                'unsigned' => TRUE,
            ],
            'Sort Order')
        ->addColumn('created_date', Varien_Db_Ddl_Table::TYPE_DATE, NULL,
            [
                'nullable' => TRUE,
            ], 'Created Date')
        ->addColumn('updated_date', Varien_Db_Ddl_Table::TYPE_DATE, NULL,
            [
                'nullable' => TRUE,
                'unsigned' => TRUE,
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