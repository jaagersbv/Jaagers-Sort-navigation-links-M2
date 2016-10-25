<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */
namespace Jaagers\Sortnavigationlinks\Block\Adminhtml\Navigationlinks\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct()
	{
		parent::_construct();
		$this->setId('jaagers_sortnavigationlinks_navigationlinks_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Navigation links'));
	}
}
