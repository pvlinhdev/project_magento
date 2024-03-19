<?php
namespace Logic\UpdateMobile\Plugin;

class UpdateCustomerMobilePlugin
{
    public function afterSave(
        \Magento\Customer\Model\ResourceModel\CustomerRepository $subject, $result, 
        \Magento\Customer\Api\Data\CustomerInterface $customer, $passwordHash = null)
    {
        // Kiểm tra xem có phải khách hàng mới được tạo hay không
        if ($customer->getId()) {
            // Cập nhật trường Mobile thành giá trị mới
            $customer->setCustomAttribute('mobile', '5666999999');
            $result = $subject->save($customer, $passwordHash);
        }
        return $result;
    }
}