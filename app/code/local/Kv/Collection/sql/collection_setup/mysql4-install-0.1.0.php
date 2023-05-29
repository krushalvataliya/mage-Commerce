<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("
--
DROP TABLE IF EXISTS `{$installer->getTable('collection')}`;
CREATE TABLE `{$installer->getTable('collection')}` (
  `collection_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `{$installer->getTable('collection')}`
  ADD PRIMARY KEY (`collection_id`);

ALTER TABLE `{$installer->getTable('collection')}`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

");

$installer->endSetup();
