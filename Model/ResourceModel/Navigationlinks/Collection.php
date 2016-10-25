<?php
namespace Jaagers\Sortnavigationlinks\Model\ResourceModel\Navigationlinks;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    public function _construct()
	{
		$this->_init('Jaagers\Sortnavigationlinks\Model\Navigationlinks', 'Jaagers\Sortnavigationlinks\Model\ResourceModel\Navigationlinks');
	}
}
	 