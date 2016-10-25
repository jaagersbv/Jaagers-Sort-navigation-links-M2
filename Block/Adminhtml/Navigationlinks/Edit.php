<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */
namespace Jaagers\Sortnavigationlinks\Block\Adminhtml\Navigationlinks;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
	/**
	 * Core registry
	 *
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry = null;

	/**
	 * @param \Magento\Backend\Block\Widget\Context $context
	 * @param \Magento\Framework\Registry $registry
	 * @param array $data
	 */
	public function __construct(
		\Magento\Backend\Block\Widget\Context $context,
		\Magento\Framework\Registry $registry,
		array $data = []
	) {
		$this->_coreRegistry = $registry;
		parent::__construct($context, $data);
	}

	/**
	 * Initialize form
	 * Add standard buttons
	 * Add "Save and Continue" button
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_objectId = 'entity_id';
		$this->_controller = 'adminhtml_navigationlinks';
		$this->_blockGroup = 'Jaagers_Sortnavigationlinks';

		parent::_construct();

		$this->buttonList->add(
			'save_and_continue_edit',
			[
				'class' => 'save',
				'label' => __('Save and Continue Edit'),
				'data_attribute' => [
					'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
				]
			],
			10
		);
	}

	/**
	 * Getter for form header text
	 *
	 * @return \Magento\Framework\Phrase
	 */
	public function getHeaderText()
	{
		$item = $this->_coreRegistry->registry('current_jaagers_sortnavigationlinks_navigationlinks');
		if ($item->getId()) {
			return __("Edit Profile '%1'", $this->escapeHtml($item->getName()));
		} else {
			return __('New Profile');
		}
	}
}
