<?php

namespace Technobit\Banner\Model\ResourceModel\Banner;

/**
 * Class Collection
 * @package Technobit\Banner\Model\ResourceModel\Banner
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * primary key field name
     * @var string
     */
    protected $_idFieldName = 'banner_id';

    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(\Technobit\Banner\Model\Banner::class, \Technobit\Banner\Model\ResourceModel\Banner::class);
    }
}
