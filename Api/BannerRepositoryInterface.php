<?php

namespace Technobit\Banner\Api;

/**
 * Interface BannerRepositoryInterface
 * @package Technobit\Banner\Api
 */
interface BannerRepositoryInterface
{
    /**
     * save banner
     * @param Data\BannerInterface $model
     * @return \Technobit\Banner\Api\Data\BannerInterface
     */
    public function save(Data\BannerInterface $model);

    /**
     * Retrieve banner
     *
     * @param int $id
     * @return \Technobit\Banner\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve banner list matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Technobit\Banner\Api\Data\BannerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete banner
     *
     * @param \Technobit\Banner\Api\Data\BannerInterface $model
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\BannerInterface $model);

    /**
     * Delete banner by ID
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}
