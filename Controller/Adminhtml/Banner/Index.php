<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

/**
 * Class Index
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class Index extends AbstractAction
{
    /**
     * Index action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->initPage();
        $resultPage->getConfig()->getTitle()->set(__('Manage Banner'));
        $resultPage->addBreadcrumb(__('Manage Banner'), __('Manage Banner'));
        return $resultPage;
    }
}
