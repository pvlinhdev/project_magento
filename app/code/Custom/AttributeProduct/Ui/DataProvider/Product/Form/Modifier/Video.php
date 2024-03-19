<?php
namespace Custom\AttributeProduct\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Field;

class Video extends AbstractModifier
{
    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive($meta, [
            'product-details' => [
                'children' => [
                    'video' => $this->getVideoFieldConfig(30),
                ],
            ],
        ]);
        return $meta;
    }

    protected function getVideoFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Product Video'),
                        'componentType' => Field::NAME,
                        'formElement' => 'fileUploader',
                        'elementTmpl' => 'ui/form/element/uploader/uploader',
                        'dataScope' => 'product.product_video',
                        'sortOrder' => $sortOrder,
                        'notice' => __('Allowed file types: avi, mp4, mov'),
                    ],
                ],
            ],
        ];
    }
}