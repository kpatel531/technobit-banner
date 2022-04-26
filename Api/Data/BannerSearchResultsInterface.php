<?php

namespace Technobit\Banner\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface BannerSearchResultsInterface
 * @package Technobit\Banner\Api\Data
 */
interface BannerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get banner list.
     *
     * @return \Technobit\Banner\Api\Data\BannerInterface[]
     */
    public function getItems();

    /**
     * Set banner list.
     *
     * @param \Technobit\Banner\Api\Data\BannerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
