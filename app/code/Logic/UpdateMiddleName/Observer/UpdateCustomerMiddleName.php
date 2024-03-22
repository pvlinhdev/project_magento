<?php
namespace Logic\UpdateMiddleName\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;

class UpdateCustomerMiddleName implements ObserverInterface
{
    protected $customerSession;
    protected $customerRepository;

    public function __construct(
        CustomerSession $customerSession,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $this->customerSession->getCustomer();
        $customerId = $customer->getId();

        if ($customerId) {
            $customerData = $this->customerRepository->getById($customerId);
            $customerData->setMiddleName('Mid');
            $this->customerRepository->save($customerData);
        }
    }
}