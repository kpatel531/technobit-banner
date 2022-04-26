<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

/**
 * Class MassStatus
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Technobit_Banner::save';

    /**
     * @var \Magento\Ui\Component\MassAction\Filter|Filter
     */
    protected $filter;

    /**
     * @var \Technobit\Banner\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Technobit\Banner\Api\BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * MassStatus constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Technobit\Banner\Model\ResourceModel\Banner\CollectionFactory $collectionFactory
     * @param \Technobit\Banner\Api\BannerRepositoryInterface $bannerRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Technobit\Banner\Model\ResourceModel\Banner\CollectionFactory $collectionFactory,
        \Technobit\Banner\Api\BannerRepositoryInterface $bannerRepository
    ){
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->bannerRepository = $bannerRepository;
        parent::__construct($context);
    }

    /**
     * MassStatus Action
     * @return \Magento\Framework\Controller\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $count = $collection->getSize();
        $status = $this->getRequest()->getParam('status');

        foreach ($collection as $model) {

            $model->setStatus($status);
            $this->bannerRepository->save($model);
        }

        $statusText = $status ? 'enabled' : 'disabled';

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been %2', $count, $statusText));

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
