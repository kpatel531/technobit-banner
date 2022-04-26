<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

/**
 * Class MassDelete
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Technobit_Banner::delete';

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
     * MassDelete constructor.
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
     * @return \Magento\Framework\Controller\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        // 1. filter collection
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $count = $collection->getSize();

        // 2. delete filtered collection item
        foreach ($collection as $model) {
            try {
                $this->bannerRepository->delete($model);
            } catch (\Exception $e) {}
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $count));

        // 3. Redirect to grid page
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
