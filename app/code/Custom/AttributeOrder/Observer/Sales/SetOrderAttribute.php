<?php
namespace Custom\AttributeOrder\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class SetOrderAttribute implements ObserverInterface
{
    protected $orderRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    public function execute(Observer $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();
            $grandTotal = $order->getGrandTotal();
            $customOrderAttribute = $grandTotal >= 200 ? "Yes" : "No";
            $order->setData('order_attribute', $customOrderAttribute);
            $this->orderRepository->save($order);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
?>