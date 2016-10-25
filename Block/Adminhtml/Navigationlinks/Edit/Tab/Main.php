<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */

// @codingStandardsIgnoreFile

namespace Jaagers\Sortnavigationlinks\Block\Adminhtml\Navigationlinks\Edit\Tab;


use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;



class Main extends Generic implements TabInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function getTabLabel()
	{
		return __('Link information');
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTabTitle()
	{
		return __('Link information');
	}

	/**
	 * {@inheritdoc}
	 */
	public function canShowTab()
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isHidden()
	{
		return false;
	}

	/**
	 * Prepare form before rendering HTML
	 *
	 * @return $this
	 * @SuppressWarnings(PHPMD.NPathComplexity)
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	protected function _prepareForm()
	{
		$model = $this->_coreRegistry->registry('current_jaagers_sortnavigationlinks_navigationlinks');
		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create();
		$form->setHtmlIdPrefix('item_');
		$fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Link Information')]);
		if ($model->getId()) {
			$fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
		}

        $fieldset->addField(
            'code',
            'text',
            ['name' => 'code', 'label' => __('Code'), 'title' => __('Code'), 'required' => true, 'disabled' => true]
        );
        $fieldset->addField(
            'group',
            'text',
            ['name' => 'group', 'label' => __('Group'), 'title' => __('Group'), 'required' => true, 'disabled' => true]
        );
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Name'), 'title' => __('Name'), 'required' => true, 'disabled' => true]
        );
		$fieldset->addField(
			'enabled',
			'checkbox',
			['name' => 'enabled', 'label' => __('Enabled'), 'title' => __('Enabled'), 'checked' => (bool)$model->getEnabled()]
		);
        $fieldset->addField(
            'sort',
            'text',
            ['name' => 'sort', 'label' => __('Sort'), 'title' => __('Sort'), 'required' => true]
        );

		$form->setValues($model->getData());
		$this->setForm($form);

		return parent::_prepareForm();
	}
}
