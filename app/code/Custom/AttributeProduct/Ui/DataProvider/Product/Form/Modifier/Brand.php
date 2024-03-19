<?php
namespace Custom\AttributeProduct\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\Component\Listing\Attribute\RepositoryInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;

class Brand extends AbstractModifier
{
    private $arrayManager;
    private $attributeRepository;

    public function __construct(
        ArrayManager $arrayManager,
        RepositoryInterface $attributeRepository
    ) {
        $this->arrayManager = $arrayManager;
        $this->attributeRepository = $attributeRepository;
    }

    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive($meta, [
            'product-details' => [
                'children' => [
                    'brand' => $this->getBrandFieldConfig(30),
                ],
            ],
        ]);
        return $meta;
    }

    protected function getBrandFieldConfig($sortOrder)
    {
        $config = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Product Brand'),
                        'componentType' => Field::NAME,
                        'formElement' => Select::NAME,
                        'dataType' => Text::NAME,
                        'dataScope' => 'product.product_brand',
                        'sortOrder' => $sortOrder,
                        'options' => $this->brandOptions->getAllOptions(),
                    ],
                ],
            ],
        ];
        return $config;
    }

    protected function getAttributeOptions()
    {
        $brandOptions = $this->brandOptions->toOptionArray();
        $options = [];
        foreach ($brandOptions as $brand) {
            $options[] = [
                'label' => $brand['label'],
                'value' => $brand['value']
            ];
        }
        return $options;
    }
}