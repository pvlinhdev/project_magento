<?php
namespace Custom\AttributeProduct\Model\Brand;

use Custom\AttributeProduct\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;
    protected $dataPersistor;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $brandCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $brandCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
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
        $data = $this->dataPersistor->get('product_brand');
        if (!empty($data)) {
            $brand = $this->collection->getNewEmptyItem();
            $brand->setData($data);
            $this->loadedData[$brand->getId()] = $brand->getData();
            $this->dataPersistor->clear('product_brand');
        }
        return $this->loadedData;
    }
}