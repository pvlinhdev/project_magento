<?php
namespace Brand\Grid\Ui\Component;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Brand\Grid\Model\ResourceModel\Brand\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $brand) {
            $this->loadedData[$brand->getId()] = $brand->getData();
        }
        return $this->loadedData;
    }
}