<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

/**
 * Class NewAction
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class NewAction extends AbstractAction
{
    /**
     * New action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
