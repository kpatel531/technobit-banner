<?php

namespace Technobit\Banner\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Technobit\Banner\Api\BannerRepositoryInterface;
use Technobit\Banner\Api\Data\BannerInterface;
use Technobit\Banner\Api\Data\BannerInterfaceFactory;
use Technobit\Banner\Api\Data\BannerSearchResultsInterfaceFactory;
use Technobit\Banner\Model\ResourceModel\Banner as BannerResource;
use Technobit\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BannerRepository
 * @package Technobit\Banner\Model
 */
class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var BannerResource
     */
    protected $resource;

    /**
     * @var BannerFactory
     */
    protected $bannerFactory;

    /**
     * @var BannerInterfaceFactory
     */
    protected $dataBannerFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var BannerSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var \Technobit\Banner\Model\Api\SearchCriteria\BannerCollectionProcessor
     */
    protected $collectionProcessor;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * BannerRepository constructor.
     * @param BannerResource $resource
     * @param BannerFactory $bannerFactory
     * @param BannerInterfaceFactory $dataBannerFactory
     * @param CollectionFactory $collectionFactory
     * @param BannerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DateTime $dateTime
     */
    public function __construct(
        BannerResource $resource,
        BannerFactory $bannerFactory,
        BannerInterfaceFactory $dataBannerFactory,
        CollectionFactory $collectionFactory,
        BannerSearchResultsInterfaceFactory $searchResultsFactory,
        DateTime $dateTime
    ) {
        $this->resource = $resource;
        $this->bannerFactory = $bannerFactory;
        $this->dataBannerFactory = $dataBannerFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dateTime = $dateTime;
    }

    /**
     * @inheritDoc
     */
    public function save(BannerInterface $model)
    {
        try {

            if (!$model->getId()) {
                $model->setCreatedAt($this->dateTime->gmtDate());
            }
            $model->setUpdatedAt($this->dateTime->gmtDate());
            $this->resource->save($model);

        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $model = $this->bannerFactory->create();
        $this->resource->load($model, $id);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('The banner with the "%1" ID doesn\'t exist.', $id));
        }
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Technobit\Banner\Model\ResourceModel\Banner\Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->getCollectionProcessor()->process($searchCriteria, $collection);

        /** @var Data\BannerSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(BannerInterface $model)
    {
        try {
            $this->resource->delete($model);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * Get new
     * @return Banner
     */
    public function getNewEmptyObject() {

        return $this->bannerFactory->create();
    }

    /**
     * @return \Technobit\Banner\Model\Api\SearchCriteria\BannerCollectionProcessor
     */
    private function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Technobit\Banner\Model\Api\SearchCriteria\BannerCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }
}
