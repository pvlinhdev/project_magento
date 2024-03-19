<?php
namespace Custom\AttrCustomer\Block\Account;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;

class Mobile extends Template
{
    protected $customerSession;
    protected $customerRepository;

    public function __construct(
        Template\Context $context,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        parent::__construct($context, $data);
    }

    public function getMobile()
    {
        $customerId = $this->customerSession->getCustomerId();
        $customer = $this->customerRepository->getById($customerId);
        return $customer->getCustomAttribute('mobile')->getValue();
    }
}