<?php
namespace Brand\Blog\Ui\Component\Listing\Blog\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Image extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item[$fieldName])) {
                    $imageUrl = $item[$fieldName];
                    $item[$fieldName . '_src'] = $imageUrl;
                    $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                    $item[$fieldName . '_link'] = $this->context->getUrl('blog/post/view', ['id' => $item['post_id']]);
                    $item[$fieldName . '_orig_src'] = $imageUrl;
                    $item[$fieldName . '_src'] = $this->getImageHtml($imageUrl);
                }
            }
        }
        return $dataSource;
    }

    protected function getImageHtml($imageUrl)
    {
        return '<img src="' . $imageUrl . '" width="100" height="100" />';
    }
    
    protected function getAlt($item)
    {
        $altField = $this->getData('config/altField') ?: '';
        return isset($item[$altField]) ? $item[$altField] : null;
    }
}