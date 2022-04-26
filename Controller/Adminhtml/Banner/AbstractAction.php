<?php

namespace Technobit\Banner\Controller\Adminhtml\Banner;

/**
 * Class AbstractAction
 * @package Technobit\Banner\Controller\Adminhtml\Banner
 */
abstract class AbstractAction extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Technobit_Banner::manage';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var \Technobit\Banner\Api\BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * AbstractAction constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Technobit\Banner\Api\BannerRepositoryInterface $bannerRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Technobit\Banner\Api\BannerRepositoryInterface $bannerRepository
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage() {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Technobit_Banner::main');
        $resultPage->addBreadcrumb(__('Technobit'), __('Technobit'));
        return $resultPage;
    }
}
