<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Edit
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class Edit extends AbstractAction
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Technobit_Banner::save';

    /**
     * Edit action
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        // 1. Get ID and create model object
        $id = $this->getRequest()->getParam('id');

        /** @var \Technobit\Banner\Model\Banner $model */
        $model = $this->bannerRepository->getNewEmptyObject();

        // 2. Initial checking
        if($id) {
            try {
                $model = $this->bannerRepository->getById($id);
            } catch (NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__('This banner no longer exists.'));
                $this->_redirect('*/*');
                return;
            }
        }
        // 3. Register current model
        $this->coreRegistry->register('current_banner', $model);

        // 4. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $pageTitle = $model->getId() ? __('Edit Banner') : __('New Banner');
        $resultPage = $this->initPage()->addBreadcrumb( $pageTitle, $pageTitle);
        $resultPage->getConfig()->getTitle()->set($pageTitle);
        return $resultPage;
    }
}
