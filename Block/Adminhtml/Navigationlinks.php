<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */
namespace Jaagers\Sortnavigationlinks\Block\Adminhtml;

class Navigationlinks extends \Magento\Backend\Block\Widget\Grid\Container
{
	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_controller = 'navigationlinks';
		$this->_headerText = __('Profiles');
		$this->_addButtonLabel = __('Add New Profile');
		parent::_construct();
        $this->removeButton('add');
	}
}
