<?php
namespace Jaagers\Sortnavigationlinks\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()
            ->newTable($setup->getTable('jaagers_sortnavigationlinks'))
            ->addColumn('entity_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 10, array(
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
                'identity' => true,
            ), 'Entity ID')
            ->addColumn('code', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, array(
                'nullable' => false,
                'default' => '',
            ), 'Title')
            ->addColumn('sort', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 11, array(
                'unsigned' => true,
                'nullable' => false,
                'default' => 1000,
            ), 'Short Desc')
            ->addColumn('enabled', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 11, array(
                'nullable' 	=> true,
                'default' 	=> '1'
            ), 'Enabled')
            ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 64, array(
            ), 'Name')
            ->addColumn('link_group', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 64, array(
            ), 'Link Group')
            ->addColumn('store_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 11, array(
                'nullable' 	=> false,
                'default' 	=> '0'
            ), 'StoreId');

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}