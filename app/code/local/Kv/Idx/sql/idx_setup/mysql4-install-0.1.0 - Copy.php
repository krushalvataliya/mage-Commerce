<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("
--
DROP TABLE IF EXISTS `{$installer->getTable('import_product_idx')}`;
CREATE TABLE `{$installer->getTable('import_product_idx')}` (
  `idx_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `collection` varchar(255) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `{$installer->getTable('import_product_idx')}`
--
ALTER TABLE `{$installer->getTable('import_product_idx')}`
  ADD PRIMARY KEY (`idx_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `{$installer->getTable('import_product_idx')}`
--
ALTER TABLE `{$installer->getTable('import_product_idx')}`
  MODIFY `idx_id` int(11) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `{$installer->getTable('import_product_idx')}` ADD UNIQUE(`sku`);
COMMIT;


");

$installer->endSetup();
