<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->run("
--
ALTER TABLE `{$this->getTable('brand')}` ADD `banner_image` VARCHAR(255) NOT NULL AFTER `image`;
ALTER TABLE `{$this->getTable('brand')}` ADD `url_key` VARCHAR(255) NOT NULL AFTER `description`;
");
$installer->endSetup();