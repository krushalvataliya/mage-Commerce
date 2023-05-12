<?php


$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("
--
DROP TABLE IF EXISTS `{$installer->getTable('salesman_address')}`;
CREATE TABLE `{$installer->getTable('salesman_address')}` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `salesman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `{$installer->getTable('salesman_address')}`
ADD PRIMARY KEY (`address_id`),
ADD KEY `salesman_id` (`salesman_id`);

ALTER TABLE `{$installer->getTable('salesman_address')}`
MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 0;

ALTER TABLE `{$installer->getTable('salesman_address')}`
ADD CONSTRAINT `salesman_address_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;
");

$installer->endSetup();
