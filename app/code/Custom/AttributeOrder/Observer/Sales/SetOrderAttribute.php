<?php
namespace Custom\AttributeOrder\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SetOrderAttribute implements ObserverInterface
{
    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();
            $grandTotal = $order->getGrandTotal();
            $customOrderAttribute = $grandTotal >= 200 ? "Yes" : "No";
            $order->setData('order_attribute', $customOrderAttribute);
            $order->save();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
?>