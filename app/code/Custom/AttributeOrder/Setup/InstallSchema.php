<?php

namespace Custom\AttrOrder\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getTable('sales_order_grid');

        $installer->getConnection()->addColumn(
            $table,
            'order_attribute',
            [
                'type' => Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'Order Attribute'
            ]
        );

        $installer->endSetup();
    }
}