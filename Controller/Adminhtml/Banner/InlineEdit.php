<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

/**
 * Class InlineEdit
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class InlineEdit extends AbstractAction
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Technobit_Banner::save';

    /**
     * InlineEdit action
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {

            $postItems = $this->getRequest()->getParam('items', []);

            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach ($postItems as $id => $data) {
                    /** @var \Technobit\Banner\Model\Banner $model */
                    $model = $this->bannerRepository->getById($id);
                    try {
                        $model->addData($data);
                        $this->bannerRepository->save($model);
                    } catch (\Exception $exception) {
                        $messages[] = "[Banner ID: {$id}]  {$exception->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $this->jsonFactory->create()->setData(['messages' => $messages, 'error' => $error]);
    }
}
