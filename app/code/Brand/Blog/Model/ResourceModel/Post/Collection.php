<?php
namespace Brand\Blog\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Brand\Blog\Model\Post', 'Brand\Blog\Model\ResourceModel\Post');
	}

}