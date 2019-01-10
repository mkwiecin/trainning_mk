<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 09.01.19
 * Time: 15:11
 */

$installer = $this;
$installer->startSetup();

$tableNameGr = $installer->getTable('powerbody_slider/group');

// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableNameGr) != true) {
    $table = $installer->getConnection()
        ->newTable($tableNameGr)
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 5,
            array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'auto_increment' => true
        ), 'Id')
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50,
            array(
            'nullable' => true,
        ), 'Name')
        ->addColumn('created_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(
            'nullable' => true,
        ), 'Created Date')
        ->addColumn('updated_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(
                'nullable' => true,
            ),
            'Updated Date');
//        ->setComment('Powerbody Slider Group Table');
    $installer->getConnection()->createTable($table);
}

$tableNameIt = $installer->getTable('powerbody_slider/item');
// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableNameIt) != true) {
    $table = $installer->getConnection()
        ->newTable($tableNameIt)
        ->addColumn('Id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
            array(
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
                'auto_increment' => true
            ),
            'Id'
        )
        ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
            array(
                'nullable' => false,
            ),
            'Title'
        )
        ->addColumn('link_url', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
            array(
            ),
            'Link url'
        )
        ->addColumn('bg_image', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
            array(
            ),
            'Bg Image'
        )
        ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
            array(),
            'Group Id'
        )
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, 15,
            array(),
            'Status'
        )
        ->addColumn('display_from', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(),
            'Display From'
        )
        ->addColumn('display_to', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(),
            'Display To'
        )
        ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
            array(
                'nullable' => false,
                'unsigned' => true,
            ),
            'Sort Order')
        ->addColumn('created_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(
            'nullable' => true,
        ), 'Created Date')
        ->addColumn('updated_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(
                'nullable' => true,
                'unsigned' => true,
            ),
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