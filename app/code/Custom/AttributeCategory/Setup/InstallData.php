<?php
namespace Custom\AttributeCategory\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;ß
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
	// text fiel
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'description',
            [
                'type'         => 'varchar',
                'label'        => 'Description',
                'input'        => 'text',
                'sort_order'   => 120,
                'source'       => '',
                'global'       => 1,
                'visible'      => true,
                'required'     => false,
                'user_defined' => false,
                'default'      => null,
                'group'        => '',
                'backend'      => ''
            ]
        );
        	// image
         $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'custom_image',
            [
                'type' => 'varchar',
                'label' => 'Category Thumbail Image',
                'input' => 'image',
                'sort_order' => 10,
                'source' => '',
                'global' => 0,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'group' => 'General Information',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image'
            ]
        );
    }
}

