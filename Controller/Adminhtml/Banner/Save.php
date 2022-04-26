<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Save
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class Save extends AbstractAction
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Technobit_Banner::save';

    /**
     * Save action
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($this->getRequest()->getPostValue()) {

            // 1. Get ID and form data
            $id = $this->getRequest()->getParam('id');
            $data = $this->getRequest()->getPostValue();

            try {
                /**
                 * @var $model \Technobit\Banner\Model\Banner
                 */
                $model = $this->bannerRepository->getNewEmptyObject();
                if($id) {
                    $model = $this->bannerRepository->getById($id);
                }

                // 2. Upload image and set data to model
                $data['image'] = $model->getImageUploader()->upload('image', $data);
                $model->setData($data);

                // 3. Save model and add message
                $this->bannerRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the banner.'));

                // 4. Redirect to edit page
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                if (!empty($id)) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
                } else {
                    return $resultRedirect->setPath('*/*/new');
                }
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the banner data.'));
                if (!empty($id)) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
                } else {
                    return $resultRedirect->setPath('*/*/new');
                }
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
