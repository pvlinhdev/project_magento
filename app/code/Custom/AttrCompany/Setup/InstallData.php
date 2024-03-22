<?php


namespace Custom\AttrCustomer\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;

class InstallData implements InstallDataInterface
{

    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'company', [
            'type' => 'varchar',
            'label' => 'Company',
            'input' => 'text',
            'source' => '',
            'required' => false,
            'visible' => true,
            'position' => 333,
            'system' => false,
            'backend' => ''
        ]);

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'company')
        ->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit'
            ]
        ]);
        $attribute->save();

        // Add company column to customer grid
        $customerList = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerList->getDefaultAttributeSetId();

        $attributeSet = $customerSetup->getEavConfig()->getAttributeSet($customerList, $attributeSetId);

        $customerSetup->addAttributeToSet(
            'customer',
            $attributeSetId,
            $attributeSet['attribute_set_id'],
            'company'
        );

        $customerList = $customerSetup->getEavConfig()->getEntityType('customer');
        $customerSetup->addAttributeToGrid(
            $customerList,
            'company'
        );
    }
}
