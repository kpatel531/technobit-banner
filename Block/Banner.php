<?php

namespace Technobit\Banner\Block;

use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Technobit\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Banner
 * @package Technobit\Banner\Block
 */
class Banner extends Template
{
    /**
     * @var BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * @var Json
     */
    protected $serializer;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    /**
     * Banner constructor.
     * @param Context $context
     * @param BannerRepositoryInterface $bannerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param Json $serializer
     * @param ScopeConfigInterface $scopeConfig
     * @param FilterProvider $filterProvider
     */
    public function __construct(
        Context $context,
        BannerRepositoryInterface $bannerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        Json $serializer,
        ScopeConfigInterface $scopeConfig,
        FilterProvider $filterProvider
    ) {
        parent::__construct($context);
        $this->bannerRepository = $bannerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->serializer = $serializer;
        $this->scopeConfig = $scopeConfig;
        $this->filterProvider = $filterProvider;
    }

    /**
     * @return \Technobit\Banner\Api\Data\BannerInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBannerList()
    {
        /** @var \Magento\Framework\Api\SortOrder $sortOrder */
        $sortOrder = $this->sortOrderBuilder
            ->setField('sort_order')
            ->setAscendingDirection()
            ->create();

        /** @var \Magento\Framework\Api\SearchCriteriaInterface $searchCriteriaBuilder */
        $searchCriteriaBuilder = $this->searchCriteriaBuilder
            ->addFilter('status', 1, 'eq')
            ->addFilter('store_id', [0, (int) $this->_storeManager->getStore()->getId()], 'in')
            ->addSortOrder($sortOrder)
            ->create();

        return $this->bannerRepository->getList($searchCriteriaBuilder)->getItems();
    }

    /**
     * @return string
     */
    public function getConfig()
    {
        $config = [
            'loop'                  => $this->isLoopEnable(),
            'autoplay'              => $this->isEnableAutoPlay(),
            'autoplayTimeout'       => $this->getAutoPlayTimeout(),
            'autoplayHoverPause'    => $this->isEnableAutoPlayHoverPush(),
            'dots'                  => $this->isEnablePager(),
            'nav'                   => $this->isEnableNavigation(),
            'items'                 => 1,
            'margin'                => 0,
            'navText'               => [],
            'navElement'            => 'div',

        ];
        return $this->serializer->serialize($config);
    }

    /**
     * Check Whether slider will be show or not
     * @return bool
     */
    public function isEnable()
    {
        return (bool) $this->getConfigValue('technobitbanner/home/enable');
    }

    /**
     * Check Whether slider loop enable or not
     * @return bool
     */
    public function isLoopEnable()
    {
        return (bool) $this->getConfigValue('technobitbanner/home/loop');
    }

    /**
     * Check Whether slider autoplay enable or not
     * @return bool
     */
    public function isEnableAutoPlay()
    {
        return (bool) $this->getConfigValue('technobitbanner/home/autoplay');
    }

    /**
     * Get slider autoplay timeout or not
     * @return bool
     */
    public function getAutoPlayTimeout()
    {
        return (int) $this->getConfigValue('technobitbanner/home/autoplay_timeout');
    }

    /**
     * Check Whether slider autoplay hover push enable or not
     * @return bool
     */
    public function isEnableAutoPlayHoverPush()
    {
        return (bool) $this->getConfigValue('technobitbanner/home/autoplay_hover_push');
    }

    /**
     * Check Whether slider navigation enable or not
     * @return bool
     */
    public function isEnableNavigation()
    {
        return (bool) $this->getConfigValue('technobitbanner/home/navigation');
    }

    /**
     * Check Whether slider pager enable or not
     * @return bool
     */
    public function isEnablePager()
    {
        return (bool) $this->getConfigValue('technobitbanner/home/pager');
    }

    /**
     * Get config value
     * @param $path
     * @return mixed
     */
    public function getConfigValue($path)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getSlideHtml($banner)
    {
        return $this->filterProvider->getBlockFilter()->filter($banner->getContent());
    }

    public function getSlideStyles($banner)
    {
        return $this->filterProvider->getBlockFilter()->filter($banner->getStyles());
    }
}
