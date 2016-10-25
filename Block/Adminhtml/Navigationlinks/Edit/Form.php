<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */
namespace Jaagers\Sortnavigationlinks\Block\Adminhtml\Navigationlinks\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct()
	{
		parent::_construct();
		$this->setId('jaagers_navigationlinks_form');
		$this->setTitle(__('Link Information'));
	}

	/**
	 * Prepare form before rendering HTML
	 *
	 * @return $this
	 */
	protected function _prepareForm()
	{
		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create(
			[
				'data' => [
					'id' => 'edit_form',
					'action' => $this->getUrl('jaagers_sortnavigationlinks/navigationlinks/save'),
					'method' => 'post',
				],
			]
		);
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}
