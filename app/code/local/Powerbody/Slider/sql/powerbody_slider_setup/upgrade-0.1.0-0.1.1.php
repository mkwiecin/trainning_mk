<?php
/** @var Mage_Core_Model_Resource_Setup $this */
$installer = $this;
$installer->startSetup();
/* @var  $connection Magento_Db_Adapter_Pdo_Mysql */
$connection = $installer->getConnection();
$tableNameIt = $this->getTable('powerbody_slider/item');
$columnNameIt = 'bg_image';

if (true === $connection->isTableExists($tableNameIt)) {
	if (true === $connection->tableColumnExists($tableNameIt, $columnNameIt)) {
		$connection->modifyColumn(
			$tableNameIt,
			$columnNameIt,
			'TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT \'Bg Image\';'
		);
	}
}
$installer->endSetup();
