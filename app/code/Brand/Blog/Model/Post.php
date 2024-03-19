<?php
namespace Brand\Blog\Model;
class Post extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Brand\Blog\Model\ResourceModel\Post');
	}
}
