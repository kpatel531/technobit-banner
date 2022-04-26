<?php

namespace Technobit\Banner\Controller\Index;

/**
 * Class Index
 * @package Technobit\Banner\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Index action
     * @return \Magento\Framework\App\ResponseInterface
     */
	public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
