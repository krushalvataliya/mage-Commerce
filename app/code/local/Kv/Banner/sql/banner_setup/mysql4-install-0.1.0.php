<?php
$installer = $this;
$installer->startSetup();

$tableBannerGroup = $installer->getConnection()
    ->newTable($installer->getTable('banner/group'))
    ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Group ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => false,
    ), 'Group Name')
    ->addColumn('group_key', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => false,
    ), 'Group Key')
    ->addColumn('height', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
    ), 'Banner Height')
    ->addColumn('width', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
    ), 'Banner Width')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
    ), 'Creation Time')
    ->setComment('Banner Group');
$installer->getConnection()->createTable($tableBannerGroup);

$tableBanner = $installer->getConnection()
    ->newTable($installer->getTable('banner/banner'))
    ->addColumn('banner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Banner ID')
    ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ), 'Group ID')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => false,
    ), 'Image Path')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => 1,
    ), 'Status')
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
    ), 'Banner Position')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
    ), 'Creation Time')
    ->addForeignKey(
        $installer->getFkName('banner/banner', 'group_id', 'banner/group', 'group_id'),
        'group_id',
        $installer->getTable('banner/group'),
        'group_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL
    )
    ->setComment('Banner');
$installer->getConnection()->createTable($tableBanner);

$installer->endSetup();
