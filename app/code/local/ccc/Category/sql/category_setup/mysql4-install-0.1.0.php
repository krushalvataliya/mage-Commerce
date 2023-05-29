<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("
--
DROP TABLE IF EXISTS `{$installer->getTable('category')}`;
CREATE TABLE `{$installer->getTable('category')}` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `{$installer->getTable('category')}`
  ADD PRIMARY KEY (`category_id`);

ALTER TABLE `{$installer->getTable('category')}`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

");

$installer->endSetup();
