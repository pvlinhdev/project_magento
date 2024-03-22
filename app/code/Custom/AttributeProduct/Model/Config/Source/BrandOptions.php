<?php
namespace Custom\AttributeProduct\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class BrandOptions extends AbstractSource
{
    public function getAllOptions()
    {
        $options = [
            ['value' => 1, 'label' => __('The beauty secrets')],
        ];
        return $options;
    }
}