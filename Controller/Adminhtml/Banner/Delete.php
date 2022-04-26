<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

/**
 * Class Delete
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class Delete extends AbstractAction
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Technobit_Banner::delete';

    /**
     * Delete action
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute() {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        // 1. Delete banner
        try {
            $id = $this->getRequest()->getParam('id');
            $this->bannerRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('You deleted the banner.'));
        } catch(\Magento\Framework\Exception\NoSuchEntityException $exception){
            $this->messageManager->addErrorMessage($exception->getMessage());
        } catch (\Magento\Framework\Exception\LocalizedException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('We can\'t delete banner right now.'));
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        // 2. Go to grid page
        return $resultRedirect->setPath('*/*/');
    }
}
