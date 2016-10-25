<?php
/**
 * Copyright © 2016 Jaagers. All rights reserved.
 */

namespace Jaagers\Sortnavigationlinks\Controller\Adminhtml\Navigationlinks;

class Index extends \Jaagers\Sortnavigationlinks\Controller\Adminhtml\Navigationlinks
{
    /**
     * Navigationlinks list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Jaagers_Sortnavigationlinks::navigationlinks');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage navigation links'));
        $resultPage->addBreadcrumb(__('Jaagers'), __('Jaagers'));
        $resultPage->addBreadcrumb(__('Profiles'), __('Profiles'));
        return $resultPage;
    }
}
